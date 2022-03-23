<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;

    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategory(['category_translation', 'category_breadcrumbs'], $id);
        $products = $this->productRepository->getProductsByCategory($id, ['product_translation']);
        
        return view('site.pages.category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
