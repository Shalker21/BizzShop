<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\BrandStoreRequest;

class BrandController extends BaseController
{
    protected $brandRepository;
    
    public function __construct(BrandContract $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandRepository->listBrands(15);

        return view('admin.Brands.index', ['brands' => $brands]);
    }

    public function getBrands(Request $request)
    {
        $this->brandRepository->getBrands($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\BrandStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $validation = $request->validated();
        $params = $request->except('_token');

        $this->brandRepository->createBrand($params);

        return redirect()->route('admin.catalog.brands')->with('create', 'Uspješno ste kreirali novi brand!');
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
        $brand = $this->brandRepository->getBrand([], $id);

        return view('admin.Brands.edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\BrandStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandStoreRequest $request)
    {
        $validation = $request->validated();
        $params = $request->except('_token');
        
        $this->brandRepository->updateBrand($params);

        return redirect()->route('admin.catalog.brands')->with('update', 'Uspješno ste ažurirali brand!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->brandRepository->deleteBrand($id);
        return redirect()->route('admin.catalog.brands')->with('delete', 'Uspješno ste obrisali Brand!');
    }
}
