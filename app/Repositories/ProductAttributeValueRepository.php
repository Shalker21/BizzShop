<?php

namespace App\Repositories;

use App\Contracts\ProductAttributeValueContract;
use App\Models\ProductAttributeValue;

/**
 * Class ProductAttributeRepository
 *
 * @package \App\Repositories
 */
class ProductAttributeValueRepository extends BaseRepository implements ProductAttributeValueContract 
{
    /**
     * ProductAttributeRepository constructor.
     * @param ProductAttributeValue $model
     */
    public function __construct(ProductAttributeValue $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProductAttributeValues(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc'){
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProductAttributeValue(array $data) {
        $attributeValue = new ProductAttributeValue($data);
        $attributeValue->save();

        return $attributeValue;
    }
    
    public function getProductAttributeValues(object $request) {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $productAttributeValue_data = $this->model->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $productAttributeValue_data = $this->model->where('_id', $search_text)
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($productAttributeValue_data);
        }

        $data_val = [];
        if(!empty($productAttributeValue_data)) {
            foreach ($productAttributeValue_data as $productAttributeValue_val) {
                
                $productAttributeValueNestedData['id'] = $productAttributeValue_val->id;
                $productAttributeValueNestedData['value'] = $productAttributeValue_val->value;
                $productAttributeValueNestedData['attribute'] = $productAttributeValue_val->attribute->type;

                $productAttributeValueNestedData['options'] = "&emsp;<a href='".route('admin.catalog.attributeValues.edit', ['id' => $productAttributeValue_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.attributeValues.delete', ['id' => $productAttributeValue_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'>OBRIŠI</span></a>";
                
                $data_val[] = $productAttributeValueNestedData;  
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
    
    public function updateProductAttributeValue(array $data, string $id){
        $attributeValue = $this->findOne($id);
        
        $attributeValue->update([
            'value' => $data['value'],
            'attribute_id' => $data['attribute_id'],
        ]);

        return $attributeValue;
    }
    
    public function getProductAttributeValue(array $with = [], string $id){
        return $this->find($with, $id);
    }
    
    public function deleteProductAttributeValue(string $id){
        $this->delete($id);
    }


}