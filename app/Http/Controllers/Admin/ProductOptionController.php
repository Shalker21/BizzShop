<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;

class ProductOptionController extends BaseController
{
    protected $productOptionRepository;
    protected $productOptionValueRepository;

    public function __construct(
        ProductOptionContract $productOptionRepository,
        ProductOptionValueContract $productOptionValueRepository
    )
    {
        $this->productOptionRepository = $productOptionRepository;
        $this->productOptionValueRepository = $productOptionValueRepository;
    }

    public function index()
    {
        return view('admin.Options.index');
    }

    public function create()
    {
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);
        
        return view('admin.Options.create', [
            'optionValues' => $optionValues,
        ]);
    }

    public function store(Request $request)
    {
        // $validation = $request->validated();
    
        $this->productOptionRepository->createProductOption($request->all());

        return back();
    }

    public function getProductOptions(Request $request)
    {
        $this->productOptionRepository->getProductOptions($request);
    }
    
}
