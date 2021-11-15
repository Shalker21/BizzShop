<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends BaseController
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductContract $productRepository,
        CategoryContract $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = $this->productRepository->listProducts(5, ['product_translation']);
    return view('admin.Products.index'/*, ['products' => $products]*/);
    }

    public function getProducts(Request $request)
    {

        $products = $this->productRepository->listProducts(0, ['product_translation']);
        $data_arr = array();
        foreach($products as $product){
            $id = $product->id;
            $name = $product->product_translation->name;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
            );
        }

        $response = array(
            "draw" => 2,
            "TotalRecords" => 11,
            "TotalDisplayRecords" => 10,
            "data" => $data_arr
        ); 

        echo json_encode($response);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(0, ['category_breadcrumbs']);
        return view('admin.Products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $validation = $request->validated();
        $params = $request->except(['_token', '_method']);
        $this->productRepository->createProduct($params);

        $products = $this->productRepository->listProducts(15, ['product_translation']);

        return redirect()->route('admin.catalog.products', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
