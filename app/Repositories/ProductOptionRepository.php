<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductVariant;
use App\Models\ProductOption;
use Illuminate\Support\Arr;
use App\Contracts\ProductOptionContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductOptionRepository extends BaseRepository implements ProductOptionContract
{
    public function __construct(ProductOption $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProductOptions(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProductOption(array $data)
    {
        $productOption = new ProductOption($data);
        $productOption->save();

        return $productOption;
    }

    public function updateProductOption(array $data, string $id) {
        
        $productOption = $this->find([], $id);

        $productOption->update([
            'optionValue_ids' => $data['optionValue_ids'],
            'code' => $data['code'],
            'name' => $data['name'],
        ]);

        return $productOption;
    }

    public function getProductOption(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function getProductOptions(object $request) {
        
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        //dd($this->model);
        if(empty($request->input('search.value'))) {
            $productOption_data = $this->model->with('values')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $productOption_data = $this->model->with('values')
            ->where('_id', $search_text)
            ->orWhere('name', 'like', "%{$search_text}%")
            ->orWhere('code', 'like', "%{$search_text}%")
            ->orWhereHas('values', function($query) use ($search_text){
                $query->where('value', 'like', "%{$search_text}%");
            })
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($productOption_data);
        }
        //dd($product_data);
        $data_val = [];
        if(!empty($productOption_data)) {
            foreach ($productOption_data as $productOption_val) {
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);
                
                $productOptionNestedData['id'] = $productOption_val->id;
                $productOptionNestedData['name'] = $productOption_val->name;
                $productOptionNestedData['product_values'] = '';
                foreach ($productOption_val->values as $value) {
                    $productOptionNestedData['product_values'] .= $value->value . ", ";
                }
                $productOptionNestedData['product_values'] = rtrim($productOptionNestedData['product_values'], ', ');
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productOptionNestedData['options'] = "&emsp;<a href='".route('admin.catalog.options.edit', ['id' => $productOption_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='#' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
                $data_val[] = $productOptionNestedData;
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