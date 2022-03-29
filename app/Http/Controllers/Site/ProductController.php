<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\BrandContract;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $optionRepository;
    protected $brandRepository;

    public function __construct(
        ProductContract $productRepository,
        CategoryContract $categoryRepository,
        ProductOptionContract $optionRepository,
        BrandContract $brandRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->optionRepository = $optionRepository;
        $this->brandRepository = $brandRepository;
    }

    public function show($id)
    {
        $product = $this->productRepository->getProduct([], $id);

        return view('site.pages.single-product');
    }   

    public function filter(Request $request)
    {
        $request['limit'] = 30;

        $variants = $this->productRepository->filterProducts($request);

        $category = $this->categoryRepository->getCategory([
            'category_translation', 
            'category_breadcrumbs', 
            'parent.category_translation', 
            'parent.parent.category_translation']
        , $request['hidden_category_id']);

        $category_root = $this->categoryRepository->getRoot([
            'category_translation', 
            'children', 
            'children.children',
            'children.category_translation', 
            'children.children.category_translation',
            'children.children.children.category_translation', 
        ]);
        
        $options = $this->optionRepository->getOptionsFromProducts($variants);
        $brands = $this->brandRepository->listBrands(0);
        
        return view('site.pages.filtered_products', [
            'category' => $category,
            'category_root' => $category_root,
            'variants' => $variants,
            'options' => $options,
            'brands' => $brands,
            'currency_symbol' => Setting::get('currency_symbol'),
        ]);
    }
}
