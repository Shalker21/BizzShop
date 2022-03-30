<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\ProductVariantContract;
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
    protected $variantRepository;

    public function __construct(
        ProductContract $productRepository,
        CategoryContract $categoryRepository,
        ProductOptionContract $optionRepository,
        BrandContract $brandRepository,
        ProductVariantContract $variantRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->optionRepository = $optionRepository;
        $this->brandRepository = $brandRepository;
        $this->variantRepository = $variantRepository;
    }

    public function show($id)
    {
       /* $variant = $this->productRepository->getProduct([
            'product_translation',
            'images',
            'variants',
            'attributes',
            'variants.variant_translation',
            'variants.images',
        ], $id);
*/
        $variant = $this->variantRepository->getProductVariant([
            'variant_translation',
            'images',
        ], $id);

        return view('site.pages.product', [
            'variant' => $variant,
        ]);
    }   

    public function filter(Request $request)
    {
        $request['limit'] = 30;
        
        $variants = $this->productRepository->filterProducts($request)->variants;

        $single_products = $this->productRepository->filterProducts($request)->products;

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

        $options_from_variants = $this->optionRepository->getOptionsFromProducts($variants);
        
        $options_from_single_products = $this->optionRepository->getOptionsFromProducts($single_products);
        
        // removes duplicate options from single_products if exists in variants
        foreach ($options_from_variants as $variant_key => $variant_value) {
            
            foreach ($options_from_single_products as $single_product_key => $single_product_value) {
            
                if ($variant_value->id === $single_product_value->id) {
            
                    $options_from_single_products->forget($single_product_key);
                }           

            } 

        }

        $brands = $this->brandRepository->listBrands(0);
        
        return view('site.pages.filtered_products', [
            'category' => $category,
            'category_root' => $category_root,
            'variants' => $variants,
            'single_products' => $single_products,
            'options_from_variants' => $options_from_variants,
            'options_from_single_products' => $options_from_single_products,
            'brands' => $brands,
            'currency_symbol' => Setting::get('currency_symbol'),
        ]);
    }
}
