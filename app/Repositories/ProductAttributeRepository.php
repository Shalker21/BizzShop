<?php

namespace App\Repositories;

use App\Models\ProductAttribute;
use App\Contracts\ProductAttributeContract;

/**
 * Class ProductAttributeRepository
 *
 * @package \App\Repositories
 */
class ProductAttributeRepository extends BaseRepository implements ProductAttributeContract 
{
    /**
     * ProductAttributeRepository constructor.
     * @param ProductAttribute $model
     */
    public function __construct(ProductAttribute $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProductAttributes(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc') {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function getProductAttributes(object $request)
    {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $productAttribute_data = $this->model->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $productAttribute_data = $this->model->where('_id', $search_text)
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($productAttribute_data);
        }

        $data_val = [];
        if(!empty($productAttribute_data)) {
            foreach ($productAttribute_data as $productAttribute_val) {
                
                $productAttributeNestedData['id'] = $productAttribute_val->id;
                $productAttributeNestedData['type'] = $productAttribute_val->type;

                $productAttributeNestedData['options'] = "&emsp;<a href='".route('admin.catalog.attributes.edit', ['id' => $productAttribute_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.attributes.delete', ['id' => $productAttribute_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'>OBRIŠI</span></a>";
                
                $data_val[] = $productAttributeNestedData;  
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

    public function createProductAttribute(array $data) {
        $attribute = new ProductAttribute($data);
        $attribute->save();

        return $attribute;
    }
    public function updateProductAttribute(array $data, string $id) {
        $attribute = $this->find([], $id);

        $attribute->update([
            'code' => $data['code'],
            'type' => $data['type'],
        ]);

        return $attribute;
    }

    public function getProductAttribute(array $with = [], string $id){
        return $this->find($with, $id);
    }

    public function deleteProductAttribute(string $id)
    {
        $attribute = $this->find(['values'], $id);
        $attribute->values()->delete();
        $this->delete($id);   
    }

    public function getAttributesFromProducts(object $variant)
    {
        $attribute_ids_from_products = [];

        if ($variant !== null) {
            $option_ids_from_products[] = $this->fillOptionIds($variant);
        }

            if ($variant->product) { // if variant
                
                $attribute_ids_from_products[] = $this->fillOptionIdsForOneProduct($variant->product);
            } else { // if unique product
                $attribute_ids_from_products[] = $this->fillOptionIdsForOneProduct($variant);
            }


        $attribute_ids_filtered = [];
        foreach ($option_ids_from_products as $key => $value) {
            foreach ($value as $key => $value) {
                $attribute_ids_filtered[] = $value;
            }
        }
        // get option_values ids from product
        
        $attributes = ProductAttribute::query();
        
        if ($variant !== null) {
            $attributes->with(['values' => function ($query) use ($variant){
                if ($variant->product) { // if variant
                    $query->whereIn('_id', (array)$variant->product->attributeValue_ids);
                } else { // if unique product
                    $query->whereIn('_id', (array)$variant->attributeValue_ids);
                }
            }]);
        }
        
        $attributes->whereIn('_id', $attribute_ids_filtered);

        $attributes = $attributes->get();

        return $attributes;
    }

    private function fillOptionIds(object $product_or_variant) : array
    {
        $option_ids_from_products = [];

        if ($product_or_variant->product) { // if variant
            if ($product_or_variant->product->attribute_ids !== "") {
                foreach($product_or_variant->product->attribute_ids as $option_id) {
        
                    if (!in_array($option_id, $option_ids_from_products)) {
            
                        $option_ids_from_products[] = $option_id;
            
                    }
                }
            }
        } else { // if unique product
            foreach($product_or_variant->attribute_ids as $option_id) {
        
                if (!in_array($option_id, $option_ids_from_products)) {
        
                    $option_ids_from_products[] = $option_id;
        
                }
        
            }
        }

        return $option_ids_from_products;
    }

    private function fillOptionIdsForOneProduct(object $product)
    {
        $option_ids_from_products = [];     
        
        if ($product->attribute_ids !== "") {

            foreach($product->attribute_ids as $option_id) {
        
                if (!in_array($option_id, $option_ids_from_products)) {
        
                    $option_ids_from_products[] = $option_id;
        
                }
        
            }
        }
        
        return $option_ids_from_products;
    }
}