<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\ProductVariantContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductAttributeContract;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\BrandContract;
use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use App\Models\ProductVariant;
use App\Models\Setting;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $optionRepository;
    protected $brandRepository;
    protected $variantRepository;
    protected $optionValueRepository;
    protected $attributeRepository;

    public function __construct(
        ProductContract $productRepository,
        CategoryContract $categoryRepository,
        ProductOptionContract $optionRepository,
        BrandContract $brandRepository,
        ProductVariantContract $variantRepository,
        ProductOptionValueContract $optionValueRepository,
        ProductAttributeContract $attributeRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->optionRepository = $optionRepository;
        $this->brandRepository = $brandRepository;
        $this->variantRepository = $variantRepository;
        $this->optionValueRepository = $optionValueRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($id)
    {
        $single_product = $this->productRepository->getProduct([
            'product_translation',
            'images',
            'stock_item',
        ], $id);
        
        $variant = $this->variantRepository->getProductVariant([
            'variant_translation',
            'images',
            'product',
            'stock_item',
        ], $id);

        if (!$variant) {

            if (!$single_product) {
            
                abort(404);
            }
            
            $variant = $single_product;
        }

        $options = $this->optionRepository->getOptionsFromProducts(null, null, $variant);
        $attributes = $this->attributeRepository->getAttributesFromProducts($variant);
        
        if ($variant->product) {
            $brand = $this->brandRepository->getBrand([], $variant->product->brand_id);
        } else {
            $brand = $this->brandRepository->getBrand([], $variant->brand_id);
        }

        $categories = $this->categoryRepository->listCategories(0, ['category_translation']);

        return view('site.pages.product', [
            'variant' => $variant,
            'options' => $options,
            'brand' => $brand,
            'attributes' => $attributes,
            'categories' => $categories,    
        ]);
    }   

    public function show_cart()
    {
        return view('site.pages.shopping_cart');
    }

    public function addToCart(Request $request, $id)
    {
        $validated = $request->validate([
            'selected_option_value' => 'required'
        ]);

        if ($validated) {
            redirect()->back()->with('error', "Morate odabrati opcije proizvoda!");
        }
        
        $single_product = $this->productRepository->getProduct([
            'product_translation',
            'images',
            'stock_item'
        ], $id);
        
        $variant = $this->variantRepository->getProductVariant([
            'variant_translation',
            'images',   
            'product',
            'stock_item'
        ], $id);

        if (!$variant) {

            if (!$single_product) {
            
                abort(404);
            }
            
            $variant = $single_product;
        }

        $options = $this->optionRepository->getOptionsWithSomeValues($request['selected_option_value']);

        $cart = session()->get('cart');
        
        // if basket is empty then this the first item
        if(!$cart) {
            $cart = [
                    $variant->id => [
                        "name" => $variant->product ? $variant->variant_translation->name : $variant->product_translation->name,
                        "item_qty" => $request['quantity'],
                        "options_with_selected_values" => $options,
                        "unit_price" => $variant->stock_item->unit_price,
                        "unit_special_price" => ($variant->stock_item->unit_special_price !== null || $variant->stock_item->unit_special_price !== "") ? $variant->stock_item->unit_special_price : null,
                        "variant_image" => $variant->images[0]->path, 
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Proizvod je stavljen u košaru!');
        }

        // if basket not empty then check if this item exist then increment item_qty
        if(isset($cart[$variant->id])) {

            $cart[$variant->id]['item_qty'] += $request['quantity'];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Proizvod je stavljen u košaru!');

        }
        // if item not exist in basket then add to basket
        $cart[$variant->id] = [
            "name" => $variant->product ? $variant->variant_translation->name : $variant->product_translation->name,
            "item_qty" => $request['quantity'],
            "options_with_selected_values" => $options,
            "unit_price" => $variant->stock_item->unit_price,
            "unit_special_price" => ($variant->stock_item->unit_special_price !== null || $variant->stock_item->unit_special_price !== "") ? $variant->stock_item->unit_special_price : null,
            "variant_image" => $variant->images[0]->path, 
        ];
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Proizvod je stavljen u košaru!');
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

        $options_from_variants = $this->optionRepository->getOptionsFromProducts(null, $variants);
        
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

    public function search(Request $request)
    {
        $products = $this->productRepository->searchProducts($request->search_bar);

        $category_root = $this->categoryRepository->getRoot([
            'category_translation', 
            'children', 
            'children.children',
            'children.category_translation', 
            'children.children.category_translation',
            'children.children.children.category_translation', 
        ]);

        $options_from_products = $this->optionRepository->getOptionsFromProducts($products);

        $brands = $this->brandRepository->listBrands(0);

        return view('site.pages.search', [
            'products' => $products,
            'options' => $options_from_products,
            'category_root' => $category_root,
            'brands' => $brands,
            'search_query' => $request->search_bar,
            'currency_symbol' => Setting::get('currency_symbol'),
        ]);
    }

    public function updateProductFromCart(Request $request, $id)
    {
        //dd($request['quantity']);
        if($id && $request['quantity'])
        {
            $cart = session()->get('cart');
            $cart[$id]["item_qty"] = $request['quantity'];
            session()->put('cart', $cart);
            session()->flash('success', 'Ažurirali ste proizvod iz košarice');
            return redirect()->back()->with('success', 'Ažurirali ste proizvod iz košarice');
        }
        abort(404);
    }

    public function removeProductFromCart($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Obrisali ste proizvod iz košarice');
            return redirect()->back()->with('success', 'Obrisali ste proizvod iz košarice');
        }
        abort(404);
    }
}
