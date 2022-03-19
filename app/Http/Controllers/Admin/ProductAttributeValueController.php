<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\ProductAttributeValueContract;
use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductContract;

class ProductAttributeValueController extends BaseController
{
    protected $productAttributeValueRepository;
    protected $productAttributeRepository;
    protected $productRepository;

    public function __construct(
        ProductAttributeValueContract $productAttributeValueRepository,
        ProductAttributeContract $productAttributeRepository,
        ProductContract $productRepository
    ) {
        $this->productAttributeValueRepository = $productAttributeValueRepository;
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
        return view('admin.AttributeValues.index');
    }

    public function getProductAttributeValues(Request $request)
    {
        $this->productAttributeValueRepository->getProductAttributeValues($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->listProducts(0, []);
        $attributes = $this->productAttributeRepository->listProductAttributes(0, []);

        return view('admin.AttributeValues.create', [
            'products' => $products,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->productAttributeValueRepository->createProductAttributeValue($request->all());

        return redirect()->route('admin.catalog.attributeValues');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
