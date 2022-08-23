<?php

namespace App\Repositories;

//use Illuminate\Support\Arr;


use App\Traits\UploadAble;
use App\Models\ProductVariant;
use App\Models\ProductVariantStockItem;
use App\Models\ProductVariantTranslation;
use App\Models\InventorySourceStock;

use App\Contracts\ProductVariantContract;
use Carbon\Carbon;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductVariantRepository extends BaseRepository implements ProductVariantContract
{
    use UploadAble;

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

        $data['available'] == "on" ? $data['available'] = true : $data['available'] = false;
        
        // TODO: need to put image_ids field into data
        $variant = new ProductVariant($data);
        $variant->save();
        $data['unit_price'] = (float)$data['unit_price'];
        if ($data['unit_special_price'] > 0) {
            $data['unit_special_price'] = (float)$data['unit_special_price'];
        }
        $data['variant_id'] = $variant->id;
        $data['product_id'] = null;

        $productVariantTranslation = new ProductVariantTranslation($data);
        $variant->variant_translation()->save($productVariantTranslation);

        $productVariantStockItem = new ProductVariantStockItem($data);
        $variant->stock_item()->save($productVariantStockItem);
        
        if (isset($data['inventory_ids'])) {
            foreach ($data['inventory_ids'] as $inventory_id) {
                $data['inventory_id'] = $inventory_id;
                $data['code'] = Carbon::now()->toString();
                $data['stock'] = $productVariantStockItem->quantity;
                
                $inventorySourceStock = new InventorySourceStock($data);
              
                $variant->source_stock()->save($inventorySourceStock);
            }
        }

        return $variant;
    }

    public function updateProductVariant(array $data, string $id) {
        
        if (!isset($data['available'])) {
            $data['available'] = false;
        } else {
            $data['available'] == "on" ? $data['available'] = true : $data['available'] = false;
        }
        
        $variant = $this->findOne($id);

        $variant->product_id = isset($data['product_id']) ? $data['product_id'] : '';
        $variant->option_ids = isset($data['option_ids']) ? $data['option_ids'] : '';
        $variant->optionValue_ids = isset($data['optionValue_ids']) ? $data['optionValue_ids'] : '';
        $variant->attribute_ids = isset($data['attribute_ids']) ? $data['attribute_ids'] : '';
        //$variant->image_ids = isset($data['image_ids'];
        $variant->code = isset($data['code']) ? $data['code'] : '';
        $variant->available = isset($data['available']) ? $data['available']: '';
        $variant->width = isset($data['width']) ? $data['width'] : '';
        $variant->height = isset($data['height']) ? $data['height'] : '';
        $variant->depth = isset($data['depth']) ? $data['depth'] : '';
        $variant->weight = isset($data['weight']) ? $data['weight'] : '';

        if ($variant->stock_item !== null) {
            $variant->stock_item->product_id = null;
            $variant->stock_item->variant_id = $variant->id;
            $variant->stock_item->quantity = isset($data['quantity']) ? $data['quantity'] : '';
            $variant->stock_item->unit_price =isset($data['unit_price']) ? (float)$data['unit_price'] : '';
            $variant->stock_item->unit_special_price = isset($data['unit_special_price']) ? (float)$data['unit_special_price'] : '';
            $variant->stock_item->unit_special_price_from = isset($data['unit_special_price_from']) ? $data['unit_special_price_from'] : '';
            $variant->stock_item->unit_special_price_to = isset($data['unit_special_price_to']) ? $data['unit_special_price_to'] : '';
            $variant->stock_item->width_measuring_unit_option_value_id = isset($data['width_measuring_unit_option_value_id']) ? $data['width_measuring_unit_option_value_id'] : '';
            $variant->stock_item->height_measuring_unit_option_value_id = isset($data['height_measuring_unit_option_value_id']) ? $data['height_measuring_unit_option_value_id'] : '';
            $variant->stock_item->depth_measuring_unit_option_value_id = isset($data['depth_measuring_unit_option_value_id']) ? $data['depth_measuring_unit_option_value_id'] : '';
            $variant->stock_item->weight_measuring_unit_option_value_id = isset($data['weight_measuring_unit_option_value_id']) ? $data['weight_measuring_unit_option_value_id'] : '';
            //$variant->stock_item->save(); because variant->push() updates its relationships and model himself.. 
        } else {
            $data['product_id'] = null;
            $data['variant_id'] = $variant->id;
            $productVariantStockItem = new ProductVariantStockItem($data);
            $variant->stock_item()->save($productVariantStockItem);
        }

        if (isset($data['inventory_ids'])) {
            foreach ($data['inventory_ids'] as $inventory_id) {
                $data['inventory_id'] = $inventory_id;
                $data['code'] = Carbon::now()->toString();
                $data['stock'] = isset($productVariantStockItem->quantity) ? $productVariantStockItem->quantity : $variant->stock_item->quantity;
                
                $inventorySourceStock = new InventorySourceStock($data);
              
                $variant->source_stock()->save($inventorySourceStock);
            }
        }
        
        $variant->variant_translation->variant_id = $variant->id;
        $variant->variant_translation->name = $data['name'];

        $variant->variant_translation->save();

        $variant->push();

        return $variant;
    }

    public function getProductVariant(array $with = [], string $id) {
        return $this->find($with, $id);
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
                $productnestedData['options'] = "&emsp;<a href='".route('admin.catalog.variants.edit', ['id' => $product_variant_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.variants.delete', ['id' => $product_variant_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded' onclick=\"return confirm('Sigurno želite obrisati varijaciju?')\"><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
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

    public function deleteProductVariant(string $id)
    {
        $variant = $this->find(['images', 'stock_item', 'variant_translation'], $id);

        $variant->variant_translation()->delete();

        foreach ($variant->images as $variant_image) {
            $this->deleteOne($variant_image->path, 's3');
        }

        $variant->images()->delete();
        $variant->stock_item()->delete();

        $this->delete($id);
    }
}
