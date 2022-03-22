<?php

namespace App\Repositories;

use App\Models\Inventory;
use App\Contracts\InventoryContract;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

/**
 * Class InventoryRepository
 *
 * @package \App\Repositories
 */
class InventoryRepository extends BaseRepository implements InventoryContract
{
    /**
     * Inventory constructor.
     * @param Inventory $model
     */
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    
    public function listInventories(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc'){
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createInventory(array $data){
        $new_inventory = $this->create($data);

        $new_inventory->save();

        return $new_inventory;
    }
    
    public function updateInventory(array $data, string $id){
        return $this->update($data, $id);
    }
    
    public function getInventory(array $with = [], string $id){
        return $this->find($with, $id);
    }
    
    public function deleteInventory(string $id){
        $inventory = $this->findOne($id);
        
        $inventory->source_stock()->delete();

        // proizvodi koji koriste to skladiste
$products_with_inventory_ids = DB::collection('products')->where('inventory_ids', $id)->get();

foreach ($products_with_inventory_ids as $product_with_inv_id) { // proizvod koji koristi to skladiste

    if (($key = array_search($id, $product_with_inv_id['inventory_ids'])) !== false) { //pronaden id u arrayu na temelju valuea a vrati key od valuea
        $array = $product_with_inv_id['inventory_ids'];
        unset($array[$key]);
        
        Product::where('_id', $product_with_inv_id['_id']->jsonSerialize()['$oid'])->update(['inventory_ids' => $array->toArray()]);
    }

}

        return $this->delete($id);
    }
    
    public function getSelectedInventory(string $source_stock_ids) {}

    public function getInventories(object $request) {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $inventory_data = $this->model->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $inventory_data = $this->model
            ->where('_id', $search_text)
            ->orWhere('name', 'like', "%{$search_text}%")
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($inventory_data);
        }

        $data_val = [];
        if(!empty($inventory_data)) {
            foreach ($inventory_data as $inventory_val) {
                
                $inventorynestedData['id'] = $inventory_val->id;
                $inventorynestedData['name'] = $inventory_val->name;
                $inventorynestedData['options'] = "&emsp;<a href='".route('admin.webshop.inventory.edit', ['id' => $inventory_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.webshop.inventory.delete', ['id' => $inventory_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'>OBRIŠI</span></a>";
                
                $data_val[] = $inventorynestedData;
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