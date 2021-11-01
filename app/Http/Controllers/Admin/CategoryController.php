<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends BaseController
{
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->listCategories(
                        ['category_translation', 'category_image'], 
                        ['id', 'parent_id', 'featured', 'menu']
        ); 
        // need to create tree array for categories
        /*
    
        category_id => root,
        category_id => root/muski
        category_id => root/muski/majice_dugi_rukavi
        category_id => root/zene
        ...
         */

        return view('admin.Categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(['category_translation']);

        return view('admin.Categories.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $validation = $request->validated();
        $params = $request->except('_token');
        
        $this->categoryRepository->createCategory($params);
        
        return redirect()->route('admin.catalog.categories');
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
        $categories = $this->categoryRepository->listCategories(['category_translation']);
        $category = $this->categoryRepository->getCategory([], $id);
        
        return view('admin.Categories.edit', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, $id)
    {
        $validation = $request->validated();
        $params = $request->except('_token');

        $this->categoryRepository->updateCategory($params, $id);
        
        return redirect()->route('admin.catalog.categories');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);
        
        if ($category) {
            return redirect()->route('admin.catalog.categories')->withMessage('success', 'Uspjesno ste obrisali kategoriju');
        } else {
            return back()->withErrors('Nije moguće obrisati kategoriju');
        }
        
    }
}
