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
}