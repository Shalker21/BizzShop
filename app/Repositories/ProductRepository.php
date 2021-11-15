<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProducts(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProduct(array $data)
    {
        $product = new Product($data);
        $product->save();
        $productTranslation = new ProductTranslation($data);
        $product->product_translation()->save($productTranslation);
        
        return $product;
    }

    public function get_products(object $request) {
        
        $totalDataRecord = count($this->listProducts(0, []));
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
            $post_data =  Product::where('_id', $search_text)
            ->orWhereHas('product_translation', function($query) use ($search_text){
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->skip($start_val)
            ->take(intval($limit_val))
            ->orderBy('id','asc')
            ->get();
            
            $totalFilteredRecord = Product::where('_id', $search_text)
            ->orWhereHas('product_translation', function($query) use ($search_text){
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
                $postnestedData['options'] = "&emsp;<a href='#'class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='#' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
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

    // here goes filters function

}