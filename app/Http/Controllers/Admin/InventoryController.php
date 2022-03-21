<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\InventoryContract;
use App\Contracts\InventorySourceStockContract;

class InventoryController extends Controller
{
    protected $inventoryRepository;
    protected $inventorySourceStockRepository;

    public function __construct(
        InventoryContract $inventoryRepository,
        InventorySourceStockContract $inventorySourceStockRepository   
    )
    {
        $this->inventoryRepository = $inventoryRepository;
        $this->inventorySourceStockRepository = $inventorySourceStockRepository;    
    }

    public function index()
    {
        return view('admin.Inventory.index');
    }

    public function getInventories(Request $request)
    {
        $this->inventoryRepository->getInventories($request);
    }
}
