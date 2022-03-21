<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;        
use App\Http\Controllers\BaseController;
use App\Contracts\InventorySourceStockContract;
use App\Contracts\InventoryContract;

class InventorySourceStockController extends BaseController
{
    protected $inventorySourceStockRepository;
    protected $inventoryRepository;

    public function __construct(InventorySourceStockContract $inventorySourceStockRepository, InventoryContract $inventoryRepository)
    {
        $this->inventorySourceStockRepository = $inventorySourceStockRepository;
        $this->inventoryRepository = $inventoryRepository;
    }

    public function getInventorySourceStocks(Request $request)
    {
        $this->inventorySourceStockRepository->getInventorySourceStocks($request);
    }

    public function edit($inventory_id)
    {
        $inventory = $this->inventoryRepository->getInventory([], $inventory_id);
        return view('admin.inventorySourceStock.edit', ['inventory' => $inventory]);
    }
}
