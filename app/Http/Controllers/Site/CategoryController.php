<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductOptionContract;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $productRepository;
    protected $optionRepository;

    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository,
        ProductOptionContract $optionRepository
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->optionRepository = $optionRepository;
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategory(['category_translation', 'category_breadcrumbs'], $id);
        $products = $this->productRepository->getProductsByCategory($id, ['product_translation', 'images', 'stock_item', 'variants', 'variants.images', 'variants.variant_translation'], 30);
        $options = $this->optionRepository->listProductOptions(0,['values']);

        return view('site.pages.category', [
            'category' => $category,
            'products' => $products,
            'options' => $options,
        ]);
    }
}
