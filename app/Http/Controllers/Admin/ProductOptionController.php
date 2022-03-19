<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\ProductOptionContract;
use App\Contracts\ProductOptionValueContract;
use App\Http\Requests\ProductOptionRequest;

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

    public function store(ProductOptionRequest $request)
    {
        $validation = $request->validated();
    
        $this->productOptionRepository->createProductOption($request->all());

        return redirect()->route('admin.catalog.options');
    }

    public function edit($id)
    {
        $productOption = $this->productOptionRepository->getProductOption([], $id);
        $optionValues = $this->productOptionValueRepository->listOptionValues(0, ['option']);

        return view('admin.Options.edit', [
            'productOption' => $productOption,
            'optionValues' => $optionValues,
        ]);
    }

    public function update(ProductOptionRequest $request, $id)
    {
        $validation = $request->validated();
    
        $this->productOptionRepository->updateProductOption($request->all(), $id);

        return redirect()->route('admin.catalog.options');
    }

    public function getProductOptions(Request $request)
    {
        $this->productOptionRepository->getProductOptions($request);
    }
    
}
