<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Contracts\BrandContract;
use App\Contracts\ProductOptionContract;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $optionRepository;
    protected $brandRepository;

    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository,
        ProductOptionContract $optionRepository,
        BrandContract $brandRepository
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->optionRepository = $optionRepository;
        $this->brandRepository = $brandRepository;
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategory([
            'category_translation', 
            'category_breadcrumbs', 
            'parent.category_translation', 
            'parent.parent.category_translation']
        , $id);

        $category_root = $this->categoryRepository->getRoot([
            'category_translation', 
            'children', 
            'children.children',
            'children.category_translation', 
            'children.children.category_translation',
            'children.children.children.category_translation', 
        ]);

        $products = $this->productRepository->getProductsByCategory($id, [
            'product_translation', 
            'images', 
            'stock_item', 
            'variants', 
            'variants.images', 
            'variants.variant_translation',
            'variants.stock_item',
        ], 10);
        
        $options = $this->optionRepository->getOptionsFromProducts($products);
        $brands = $this->brandRepository->listBrands(0);

        return view('site.pages.category', [
            'category' => $category,
            'category_root' => $category_root,
            'products' => $products,
            'options' => $options,
            'brands' => $brands,
            'currency_symbol' => Setting::get('currency_symbol'),
        ]);
    }

}
