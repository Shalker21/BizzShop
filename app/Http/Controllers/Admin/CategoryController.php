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
        /*
            for pagination we don't show root in table so, if we put 20 per page we will get
            visually 19 categories in table, root category is hidden!
        */
        $categories = $this->categoryRepository->listCategories(
                        15, // perPage
                        ['category_translation', 'category_image', 'category_breadcrumbs'], 
                        ['id', 'parent_id', 'featured', 'menu']
        ); 

        return view('admin.Categories.index', [
            'categories' => $categories,
        ]);
    }

    // get categories for datatable, ajax call
    public function getCategories(Request $request) {
        $this->categoryRepository->getCategories($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(15, ['category_translation', 'category_breadcrumbs']);
        
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
        
        return redirect()->route('admin.catalog.categories')->with('create', 'Uspješno ste kreirali novu kategoriju!');
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
        $category = $this->categoryRepository->getCategory(['category_translation', 'category_image'], $id);
        $categories = $this->categoryRepository->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        
        
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
        
        return redirect()->route('admin.catalog.categories')->with('update', 'Uspješno ste ažurirali kategoriju!');  
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
            return redirect()->route('admin.catalog.categories')->with('delete', 'Uspješno ste obrisali kategoriju!');
        } else {
            return back()->with('create', 'Nešto nije uredu, pokušajte ponovno kasnije!');
        }
        
    }
}
