<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function show($id)
    {
        $product = $this->productRepository->getProduct([], $id);

        return view('site.pages.single-product');
    }   

    public function filter(Request $request)
    {
        $products = $this->productRepository->filterProducts($request);
        
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
