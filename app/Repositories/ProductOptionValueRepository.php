<?php

namespace App\Repositories;

use App\Models\ProductOptionValue;
use Illuminate\Support\Arr;
use App\Contracts\ProductOptionValueContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductOptionValueRepository extends BaseRepository implements ProductOptionValueContract
{
    public function __construct(ProductOptionValue $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listOptionValues(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createOptionValues(array $data)
    {
        //dd($data);
        $productOptionValue = new ProductOptionValue($data);
        $productOptionValue->save();

        return $productOptionValue;
    }

    public function getOptionValues(object $request) {
        
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        //dd($this->model);
        if(empty($request->input('search.value'))) {
            $product_data = $this->model->with('option')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            //dd($product_data);
        } else {
            $search_text = $request->input('search.value');
            $product_data = $this->model->with('option')
            ->where('_id', $search_text)
            ->orWhere('value', 'like', "%{$search_text}%")
            ->orWhereHas('option', function($query) use ($search_text){
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($product_data);
        }
        
        $data_val = [];
        if(!empty($product_data)) {
            foreach ($product_data as $product_val) {
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);
                
                $productnestedData['id'] = $product_val->id;
                $productnestedData['name'] = $product_val->value;
                $productnestedData['product_option'] = $product_val->option->name;
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productnestedData['options'] = "&emsp;<a href='#'class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='#' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
                $data_val[] = $productnestedData;
            }
        }

        $draw_val = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        ];
        
        echo json_encode($get_json_data);
    }
}