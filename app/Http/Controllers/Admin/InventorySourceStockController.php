<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\InventorySourceStockContract;

class InventorySourceStockController extends Controller
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
