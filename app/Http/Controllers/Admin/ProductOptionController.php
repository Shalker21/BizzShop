<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\ProductOptionContract;

class ProductOptionController extends BaseController
{
    protected $productOptionRepository;

    public function __construct(
        ProductOptionContract $productOptionRepository
    )
    {
        $this->productOptionRepository = $productOptionRepository;
    }

    public function index()
    {
        return view('admin.Options.index');
    }

    public function create()
    {
        return view('admin.Options.create');
    }

    public function getProductOptions(Request $request)
    {
        $this->productOptionRepository->getProductOptions($request);
    }
    
}
