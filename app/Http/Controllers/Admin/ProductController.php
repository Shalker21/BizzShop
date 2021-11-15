<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\CategoryContract;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends BaseController
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductContract $productRepository,
        CategoryContract $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = $this->productRepository->listProducts(5, ['product_translation']);
    return view('admin.Products.index'/*, ['products' => $products]*/);
    }

    public function getProducts(Request $request)
    {

        //$products = Product::with('product_translation')->get(['id', 'name']);//$this->productRepository->listProducts(0, ['product_translation']);
        $totalDataRecord = 11;//count($products);
        $columns_list = array(
            0 =>'id',
            1 =>'name',
        );

        $totalFilteredRecord = $totalDataRecord;
 
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        //$order_val = $columns_list[$request->input('order.0.column')];
        //$dir_val = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))) {
            $post_data = Product::with('product_translation')->skip($start_val)
            ->take(intval($limit_val))
            ->orderBy('id','asc')
            ->get();
        }
        else {
            $search_text = $request->input('search.value');
            
            $post_data =  Product::whereHas('product_translation', function($query) {
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->orWhere('id','like',"%{$search_text}%")
            ->skip($start_val)
            ->take(intval($limit_val))
            ->orderBy('id','asc')
            ->get();
            
            $totalFilteredRecord = Product::whereHas('product_translation', function($query) {
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->orWhere('id','like',"%{$search_text}%")
            ->count();
        }

        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);
                
                $postnestedData['id'] = $post_val->id;
                $postnestedData['name'] = $post_val->product_translation->name;
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                //$postnestedData['options'] = "&emsp;<a href='{$datashow}'class='showdata' title='SHOW DATA' ><span class='showdata glyphicon glyphicon-list'></span></a>&emsp;<a href='{$dataedit}' class='editdata' title='EDIT DATA' ><span class='editdata glyphicon glyphicon-edit'></span></a>";
                $data_val[] = $postnestedData;
            }
        }

        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );
        
        echo json_encode($get_json_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories(0, ['category_breadcrumbs']);
        return view('admin.Products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $validation = $request->validated();
        $params = $request->except(['_token', '_method']);
        $this->productRepository->createProduct($params);

        $products = $this->productRepository->listProducts(15, ['product_translation']);

        return redirect()->route('admin.catalog.products', ['products' => $products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
