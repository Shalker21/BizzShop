<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Contracts\CategoryContract;

class HomeController extends Controller
{
    protected $categoryRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryContract $categoryRepository)
    {
        //$this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_image']);
        
        return view('site.pages.homepage', ['categories' => $categories]);
    }
}
