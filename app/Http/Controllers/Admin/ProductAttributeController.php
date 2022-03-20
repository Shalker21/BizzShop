<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductContract;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreAttributeRequest;

class ProductAttributeController extends BaseController
{
    /**
     * @var ProductAttributeContract
     */
    protected $productAttributeRepository;
    protected $productRepository;

    public function __construct(
        ProductAttributeContract $productAttributeRepository,
        ProductContract $productRepository
    ) {
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Attributes.index');
    }

    public function getProductAttributes(Request $request)
    {
        $this->productAttributeRepository->getProductAttributes($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->listProducts(0, ['product_translation']);

        return view('admin.Attributes.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeRequest $request)
    {
        $validation = $request->validated();

        $this->productAttributeRepository->createProductAttribute($request->all());

        return redirect()->route('admin.catalog.attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAttribute $productAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productAttribute = $this->productAttributeRepository->getProductAttribute([], $id);
        $products = $this->productRepository->listProducts(0, ['product_translation']);

        return view('admin.Attributes.edit', [
            'attribute' => $productAttribute,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAttributeRequest $request, $id)
    {
        $validation = $request->validated();

        $this->productAttributeRepository->updateProductAttribute($request->all(), $id);

        $productAttribute = $this->productAttributeRepository->getProductAttribute([], $id);
        $products = $this->productRepository->listProducts(0, ['product_translation']);

        return view('admin.Attributes.edit', [
            'attribute' => $productAttribute,
            'products' => $products,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAttribute  $productAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productAttributeRepository->deleteProductAttribute($id);
        
        return back()->with('delete', 'Uspjesno ste obrisali Atribut!');
    }
}
