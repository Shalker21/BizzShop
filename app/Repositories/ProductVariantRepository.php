<?php

namespace App\Repositories;

//use Illuminate\Support\Arr;

//use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantStockItem;
use App\Models\ProductVariantTranslation;

use App\Contracts\ProductVariantContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductVariantRepository extends BaseRepository implements ProductVariantContract
{
    public function __construct(ProductVariant $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProductVariants(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProductVariant(array $data)
    {
        //dd($data);

        // TODO: need to put image_ids field into data
        $variant = new ProductVariant($data);
        $variant->save();

        $data['variant_id'] = $variant->id;

        $productVariantTranslation = new ProductVariantTranslation($data);
        $variant->variant_translation()->save($productVariantTranslation);

        $productVariantStockItem = new ProductVariantStockItem($data);
        $variant->stock_item()->save($productVariantStockItem);
        
        return $variant;
    }

    public function updateProductVariant(array $data, string $id) {
        /*$data['enabled'] == "on" ? $data['enabled'] = true : $data['enabled'] = false;
        
        $product = Product::find($id);

        $product->category_ids = $data['category_ids'];
        $product->variant_ids = $data['variant_ids'];
        $product->option_ids = $data['option_ids'];
        $product->optionValue_ids = $data['optionValue_ids'];
        $product->brand_id = $data['brand_id'];
        $product->code = $data['code'];
        $product->quantity_total = $data['quantity_total'];
        $product->enabled = $data['enabled'];

        $product->product_translation->name = $data['name'];
        $product->product_translation->slug = $data['slug'];
        $product->product_translation->description = $data['description'];
        $product->product_translation->short_description = $data['short_description'];
        $product->product_translation->meta_keywords = $data['meta_keywords'];
        $product->product_translation->meta_description = $data['meta_description'];
        
        //$product->product_translation->save();
        
        $product->push();
        
        return $product;*/

        dd($data);
    }

    public function get_product_variants(object $request) {
        
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $product_variant_data = $this->model->with(['variant_translation', 'options'])
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $product_variant_data = $this->model->with(['variant_translation', 'options'])
            ->where('_id', $search_text)
            ->orWhereHas('variant_translation', function($query) use ($search_text){
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->orWhereHas('options', function($query) use ($search_text){
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($product_variant_data);
        }
        
        $data_val = [];
        if(!empty($product_variant_data)) {
            foreach ($product_variant_data as $product_variant_val) {
                //dd($product_val['options']);
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);
                //dd($product_val);
                $productnestedData['id'] = $product_variant_val->id;
                $productnestedData['name'] = $product_variant_val->variant_translation->name;
                /*$productnestedData['product_options'] = '';
                foreach ($product_val->options as $option) {
                    $productnestedData['product_options'] .= $option->name . ", ";
                }*/
                //$productnestedData['product_options'] = rtrim($productnestedData['product_options'], ', ');
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productnestedData['options'] = "&emsp;<a href='".route('admin.catalog.variants.edit', ['id' => $product_variant_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.variants.edit', ['id' => $product_variant_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
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
