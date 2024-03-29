<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\ProductImageContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductAttributeValueContract;
use App\Contracts\InventoryContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductVariantStoreRequest;
use Illuminate\Support\Arr;

class ProductVariantController extends BaseController
{
    protected $productRepository;
    protected $productImageRepository;
    protected $productVariantRepository;
    protected $productOptionValueRepository;
    protected $productOptionRepository;
    protected $productAttributeRepository;
    protected $productAttributeValueRepository;
    protected $inventoryRepository;

    public function __construct(
        ProductContract $productRepository,
        ProductImageContract $productImageRepository,
        ProductVariantContract $productVariantRepository,
        ProductOptionContract $productOptionRepository,
        ProductOptionValueContract $productOptionValueRepository,
        ProductAttributeContract $productAttributeRepository,
        ProductAttributeValueContract $productAttributeValueRepository,
        InventoryContract $inventoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->productOptionValueRepository = $productOptionValueRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productAttributeValueRepository = $productAttributeValueRepository;
        $this->inventoryRepository = $inventoryRepository;
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
        $options = $this->productOptionRepository->listProductOptions(0);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        $attributes = $this->productAttributeRepository->listProductAttributes(0);
        $attributeValues = $this->productAttributeValueRepository->listProductAttributeValues(0);
        $inventories = $this->inventoryRepository->listInventories(0);

        return view('admin.Variants.create', [
            'products' => $products,
            //'variants' => $variants,
            'optionValues' => $optionValues,
            'options' => $options,
            'attributes' => $attributes,
            'attributeValues' => $attributeValues,
            'inventories' => $inventories,
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

        $variant = $this->productVariantRepository->createProductVariant($request->except(['_token', '_method', 'submit_store_product']));
        if ($request->file('variant_images')) {
            $this->productImageRepository->createImageProduct($request->file('variant_images'), $variant->id, 'variants', 's3'); // store variant images
        }

        $variants = $this->productVariantRepository->listProductVariants(15, ['variant_translation']);

        return redirect()->route('admin.catalog.variants', ['variants' => $variants])->with('create', 'Uspješno ste kreirali novu varijaciju!');
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
        $variant = $this->productVariantRepository->getProductVariant(['variant_translation', 'stock_item', 'images'], $id);
       
        // measurment units (cm, m, kg, m2, etc.) 
        $options = $this->productOptionRepository->listProductOptions();
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        $attributes = $this->productAttributeRepository->listProductAttributes(0);
        $attributeValues = $this->productAttributeValueRepository->listProductAttributeValues(0);
        $inventories = $this->inventoryRepository->listInventories(0);

        return view('admin.Variants.edit', [
            'products' => $products,
            'variant' => $variant,
            'optionValues' => $optionValues,
            'options' => $options,
            'attributes' => $attributes,
            'attributeValues' => $attributeValues,
            'inventories' => $inventories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductVariantStoreRequest  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function update(ProductVariantStoreRequest $request, $id)
    {
        $validation = $request->validated();

        $this->productVariantRepository->updateProductVariant($request->except('variant_images'), $id);
        if ($request->file('variant_images') && Arr::get($request, 'image_id') == null) {
            $this->productImageRepository->createImageProduct($request->file('variant_images'), $id, 'variants', 's3'); // store product images
        }

        return redirect()->route('admin.catalog.variants')->with('update', 'Uspješno ste ažurirali Varijaciju!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVariant  $productVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productVariantRepository->deleteProductVariant($id);

        return back()->with('delete', 'Uspješno ste obrisali Varijaciju!');
    }
}
