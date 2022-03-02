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
        //dd($data);
        $data['enabled'] == "on" ? $data['enabled'] = true : $data['enabled'] = false;
        //$data['category_ids'] = explode(",", $data['category_ids']);
        
        $product = new Product($data);
        $product->save();
        
        $data['product_id'] = $product->id;

        $productTranslation = new ProductTranslation($data);
        $product->product_translation()->save($productTranslation);
        
        return $product;
    }

    public function updateProduct(array $data, string $id) {
        
        $data['enabled'] == "on" ? $data['enabled'] = true : $data['enabled'] = false;
        
        $product = $this->findOne($id);

        $product->category_ids = isset($data['category_ids']) ? $data['category_ids'] : '';
        $product->variant_ids = isset($data['variant_ids']) ? $data['variant_ids'] : '';
        $product->option_ids = isset($data['option_ids']) ? $data['option_ids'] : '';
        $product->optionValue_ids = isset($data['optionValue_ids']) ? $data['optionValue_ids'] : '';
        $product->attribute_ids = isset($data['attribute_ids']) ? $data['attribute_ids'] : '';
        $product->brand_id = isset($data['brand_id']) ? $data['brand_id'] : '';
        $product->code = isset($data['code']) ? $data['code'] : '';
        $product->quantity_total = isset($data['quantity_total']) ? $data['quantity_total'] : '';
        $product->enabled = isset($data['enabled']) ? $data['enabled'] : '';

        $product->product_translation->name = isset($data['name']) ? $data['name'] : '';
        $product->product_translation->slug = isset($data['slug']) ? $data['slug'] : '';
        $product->product_translation->description = isset($data['description']) ? $data['description'] : '';
        $product->product_translation->short_description = isset($data['short_description']) ? $data['short_description'] : '';
        $product->product_translation->meta_keywords = isset($data['meta_keywords']) ? $data['meta_keywords'] : '';
        $product->product_translation->meta_description = isset($data['meta_description']) ? $data['meta_description'] : '';
        
        //$product->product_translation->save();
        
        $product->push(); // push is for updating and saving model and its relations
        
        return $product;
    }

    public function getProduct(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function get_products(object $request) {
        
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $product_data = $this->model->with('product_translation')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $product_data = $this->model->with('product_translation')
            ->where('_id', $search_text)
            ->orWhereHas('product_translation', function($query) use ($search_text){
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
                $productnestedData['name'] = $product_val->product_translation->name;
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productnestedData['options'] = "&emsp;<a href='".route('admin.catalog.products.edit', ['id' => $product_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.products.edit', ['id' => $product_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
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


    // here goes filters function

}