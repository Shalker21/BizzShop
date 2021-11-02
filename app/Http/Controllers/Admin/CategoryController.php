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
        //$categories_tree_hierarchy = $this->categoryRepository->recCategories(['category_translation']);
        $categories = $this->categoryRepository->listCategories(
                        ['category_translation', 'category_image', 'category_breadcrumbs'], 
                        ['id', 'parent_id', 'featured', 'menu']
        ); 

        //dd($categories_tree_hierarchy);
        return view('admin.Categories.index', [
            'categories' => $categories,
            //'categories_tree_hierarchy' => $categories_tree_hierarchy,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(['category_translation', 'category_breadcrumbs']);
        
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
        //$categories_tree_hierarchy = $this->categoryRepository->recCategories(['category_translation']);
        $category = $this->categoryRepository->getCategory(['category_translation', 'category_image'], $id);
        $categories = $this->categoryRepository->listCategories(['category_translation', 'category_breadcrumbs']);
        
        
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
