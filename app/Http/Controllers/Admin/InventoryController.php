<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;        
use App\Http\Controllers\BaseController;
use App\Contracts\InventoryContract;
use App\Contracts\InventorySourceStockContract;

class InventoryController extends BaseController
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

    public function create()
    {
        return view('admin.Inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'location' => 'required',
        ]);

        $inventory = $this->inventoryRepository->createInventory($validated);

        return redirect()->route('admin.webshop.inventory');
    }

    public function edit($id)
    {
        $inventory = $this->inventoryRepository->getInventory([], $id);
        
        return view('admin.Inventory.edit',['inventory' => $inventory]);   
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'location' => 'required',
        ]); 

        $this->inventoryRepository->updateInventory($validated, $id);

        return view('admin.Inventory.edit', [
            'inventory' => $this->inventoryRepository->getInventory([], $id)]);
    }

    public function destroy($id)
    {
        $this->inventoryRepository->deleteInventory($id);
        return view('admin.Inventory.index')->with('delete', 'Obrisali ste skladište!');
    }
}
