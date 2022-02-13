<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\ProductVariantContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductVariantStoreRequest;

class ProductVariantController extends BaseController
{
    protected $productRepository;
    protected $productVariantRepository;
    protected $productOptionValueRepository;
    protected $productOptionRepository;

    public function __construct(
        ProductContract $productRepository,
        ProductVariantContract $productVariantRepository,
        ProductOptionContract $productOptionRepository,
        ProductOptionValueContract $productOptionValueRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->productOptionValueRepository = $productOptionValueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Variants.index');
    }

    public function getProductVariants(Request $request)
    {
        $this->productVariantRepository->get_product_variants($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->listProducts(0, ['product_translation']);
        //$variants = $this->productVariantRepository->listProductVariants(0, []);
        
        // measurment units (cm, m, kg, m2, etc.) 
        $options = $this->productOptionRepository->listProductOptions();
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);

        return view('admin.Variants.create', [
            'products' => $products,
            //'variants' => $variants,
            'optionValues' => $optionValues,
            'options' => $options,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductVariantStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductVariantStoreRequest $request)
    {
        $validation = $request->validated();

        $this->productVariantRepository->createProductVariant($request->except(['_token', '_method', 'submit_store_product']));
        
        $variants = $this->productVariantRepository->listProductVariants(15, ['variant_translation']);

        return redirect()->route('admin.catalog.variants', ['variants' => $variants]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = $this->productRepository->listProducts(0, ['product_translation']);
        //$variant = $this->productVariantRepository->getProductVariants(0, []);
        
        // measurment units (cm, m, kg, m2, etc.) 
        $options = $this->productOptionRepository->listProductOptions();
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);

        return view('admin.Variants.create', [
            'products' => $products,
            //'variants' => $variants,
            'optionValues' => $optionValues,
            'options' => $options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariant $productVariant)
    {
        //
    }
}
