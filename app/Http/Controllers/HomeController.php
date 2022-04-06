<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Models\Setting;

class HomeController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        //$this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $category_root = $this->categoryRepository->getRoot(['category_translation', 'children', 'children.category_translation', 'children.category_image']);
        $products = $this->productRepository->listProducts(10, ['product_translation', 'images', 'variants', 'stock_item', 'variants.images', 'variants.variant_translation', 'variants.stock_item']);
        $newestProducts = $this->productRepository->listProducts(3, ['product_translation', 'images', 'stock_item', 'variants', 'variants.images', 'variants.stock_item', 'variants.variant_translation'], ['*'], 'created_at', 'desc'); //getNewestProducts(3, );

        return view('site.pages.homepage', [
            'category_root' => $category_root,
            'products' => $products,
            'newestProducts' => $newestProducts,
            'currency_symbol' => Setting::get('currency_symbol'),
        ]);
    }
}
