<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\ProductImageContract;
use App\Contracts\CategoryContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductAttributeValueContract;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseController
{
    protected $productRepository;
    protected $productImageRepository;
    protected $categoryRepository;
    protected $brandRepository;
    protected $productVariantRepository;
    protected $productOptionRepository;
    protected $productOptionValueRepository;
    protected $productAttributeRepository;
    protected $productAttributeValueRepository;

    public function __construct(
        BrandContract $brandRepository,
        ProductContract $productRepository,
        ProductImageContract $productImageRepository,
        CategoryContract $categoryRepository,
        ProductVariantContract $productVariantRepository,
        ProductOptionContract $productOptionRepository,
        ProductOptionValueContract $productOptionValueRepository,
        ProductAttributeContract $productAttributeRepository,
        ProductAttributeValueContract $productAttributeValueRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->productOptionValueRepository = $productOptionValueRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productAttributeValueRepository = $productAttributeValueRepository;
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
        $attributes = $this->productAttributeRepository->listProductAttributes(0, []);
        $attributeValues = $this->productAttributeValueRepository->listProductAttributeValues(0);

        return view('admin.Products.create', [
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
            'attributes' => $attributes,
            'attributeValues' => $attributeValues,
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
        // TODO: Create image validation
        $product = $this->productRepository->createProduct($request->except('product_images'));
        if ($request->file('product_images')) {
            $this->productImageRepository->createImageProduct($request->file('product_images'), $product->id, 'products', 's3'); // store product images
        }
        
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
        $product = $this->productRepository->getProduct(['product_translation', 'images', 'stock_item'], $id);
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        $brands = $this->brandRepository->listBrands(0, []);
        $variants = $this->productVariantRepository->listProductVariants(0, ['variant_translation']);
        $options = $this->productOptionRepository->listProductOptions(0);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        $attributes = $this->productAttributeRepository->listProductAttributes(0);  
        $attributeValues = $this->productAttributeValueRepository->listProductAttributeValues(0);
        
        return view('admin.Products.edit', [
            'product' => $product,
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
            'attributes' => $attributes,
            'attributeValues' => $attributeValues,
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
        
        $this->productRepository->updateProduct($request->except('product_images'), $id);
        
        if ($request->file('product_images')) {
            //$this->productImageRepository->updateImageProduct([$request->file('product_images'), $request->image_id], $id, 'products', 's3'); // store product images
        }

        $product = $this->productRepository->getProduct(['product_translation', 'images', 'stock_item'], $id);
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        $brands = $this->brandRepository->listBrands(0, []);
        $variants = $this->productVariantRepository->listProductVariants(0, ['variant_translation']);
        $options = $this->productOptionRepository->listProductOptions(0);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        $attributes = $this->productAttributeRepository->listProductAttributes(0);
        $attributeValues = $this->productAttributeValueRepository->listProductAttributeValues(0);
        
        return view('admin.Products.edit', [
            'product' => $product,
            'categories' => $categories, 
            'variants' => $variants, 
            'options' => $options,
            'optionValues' => $optionValues,
            'brands' => $brands,
            'attributes' => $attributes,
            'attributeValues' => $attributeValues
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
    }
}
