<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;        
use App\Http\Controllers\BaseController;
use App\Contracts\InventorySourceStockContract;

class InventorySourceStockController extends BaseController
{
    protected $inventorySourceStockRepository;

    public function __construct(InventorySourceStockContract $inventorySourceStockRepository)
    {
        $this->inventorySourceStockRepository = $inventorySourceStockRepository;
    }

    public function getInventorySourceStocks(Request $request)
    {
        $this->inventorySourceStockRepository->getInventorySourceStocks($request);
    }
}
