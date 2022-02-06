<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends BaseController
{
    protected $productRepository;
    protected $categoryRepository;
    protected $brandRepository;
    protected $productVariantRepository;
    protected $productOptionRepository;
    protected $productOptionValueRepository;

    public function __construct(
        BrandContract $brandRepository,
        ProductContract $productRepository,
        CategoryContract $categoryRepository,
        ProductVariantContract $productVariantRepository,
        ProductOptionContract $productOptionRepository,
        ProductOptionValueContract $productOptionValueRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
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
        //$products = $this->productRepository->listProducts(5, ['product_translation']);
        return view('admin.Products.index'/*, ['products' => $products]*/);
    }

    public function getProducts(Request $request)
    {
        $this->productRepository->get_products($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        $variants = $this->productVariantRepository->listProductVariants(0, ['variant_translation']);
        $options = $this->productOptionRepository->listProductOptions();
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        $brands = $this->brandRepository->listBrands(0, []);

        return view('admin.Products.create', [
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
        ]);
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
        
        $this->productRepository->createProduct($request->all());

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
    public function edit($id)
    {
        $product = $this->productRepository->getProduct(['product_translation'], $id);
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        $brands = $this->brandRepository->listBrands(0, []);
        $variants = $this->productVariantRepository->listProductVariants(0, ['variant_translation']);
        $options = $this->productOptionRepository->listProductOptions(0);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);

        return view('admin.Products.edit', [
            'product' => $product,
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {
        $validation = $request->validated();
        
        $this->productRepository->updateProduct($request->all(), $id);

        $product = $this->productRepository->getProduct(['product_translation'], $id);
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        $brands = $this->brandRepository->listBrands(0, []);
        $variants = $this->productVariantRepository->listProductVariants(0, ['variant_translation']);
        $options = $this->productOptionRepository->listProductOptions(0);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        
        return view('admin.Products.edit', [
            'product' => $product,
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
        ]);
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
