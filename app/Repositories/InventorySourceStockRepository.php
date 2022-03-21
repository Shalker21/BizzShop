<?php

namespace App\Repositories;

use App\Models\InventorySourceStock;
use App\Contracts\InventorySourceStockContract;

/**
 * Class InventorySourceStockRepository
 *
 * @package \App\Repositories
 */
class InventorySourceStockRepository extends BaseRepository implements InventorySourceStockContract
{
    /**
     * InventorySourceStockRepository constructor.
     * @param InventorySourceStock $model
     */
    public function __construct(InventorySourceStock $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listInventorySourceStocks(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc'){}
    
    public function createInventorySourceStock(array $data){}
    
    public function updateInventorySourceStock(array $data, string $id) {}
    
    public function getInventorySourceStock(array $with = [], string $id) {}
    
    public function deleteInventorySourceStock(string $id) {}
    
    public function getSelectedInventorySourceStock(string $category_ids) {}
    
    public function getInventorySourceStocks(object $request) {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $inventory_source_stock_data = $this->model->with('products', 'variants')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $inventory_source_stock_data = $this->model
            ->where('_id', $search_text)
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($inventory_source_stock_data);
        }

        $data_val = [];
        if(!empty($inventory_source_stock_data)) {
            foreach ($inventory_source_stock_data as $inventory_source_stock_val) {
                
                $inventorysourcestocknestedData['id'] = $inventory_source_stock_val->id;
                $inventorysourcestocknestedData['product_name'] = $inventory_source_stock_val->products->name;
                $inventorysourcestocknestedData['variant_name'] = $inventory_source_stock_val->variants->name;
                $inventorysourcestocknestedData['available_stock'] = "<form action='".route('admin.webshop.inventorySourceStock.update', ['id' => $inventory_source_stock_val->id])."' method='POST'><input value='".$inventory_source_stock_val->stock."' class='border border-blue-500 hover:border-transparent rounded'/><button type='submit' name='submit' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mx-3'>AŽURIRAJ</button></form>";
                
                $data_val[] = $inventorysourcestocknestedData;
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
