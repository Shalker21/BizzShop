<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\ProductOptionValueContract;
use App\Contracts\ProductOptionContract;
use App\Http\Requests\ProductOptionValueRequest;
use Illuminate\Support\Facades\Redirect;

class ProductOptionValueController extends Controller
{
    protected $productOptionValueRepository;
    protected $productOptionRepository;

    public function __construct(
        ProductOptionValueContract $productOptionValueRepository,
        ProductOptionContract $productOptionRepository
    )
    {
        $this->productOptionValueRepository = $productOptionValueRepository;
        $this->productOptionRepository = $productOptionRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.OptionValues.index');
    }

    public function getOptionValues(Request $request)
    {
        $this->productOptionValueRepository->getOptionValues($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = $this->productOptionRepository->listProductOptions(0);

        return view('admin.OptionValues.create', [
            'options' => $options,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductOptionValueRequest $request)
    {
        $validation = $request->validated();
        $this->productOptionValueRepository->createOptionValues($request->all());

        return view('admin.OptionValues.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $optionValue = $this->productOptionValueRepository->getOptionValue([], $id);
        $options = $this->productOptionRepository->listProductOptions(0);

        return view('admin.OptionValues.edit', [
            'optionValue' => $optionValue,
            'options' => $options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductOptionValueRequest $request, $id)
    {
        $validation = $request->validated();

        $this->productOptionValueRepository->updateOptionValues($request->all(), $id);

        return redirect()->route('admin.catalog.optionValues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
