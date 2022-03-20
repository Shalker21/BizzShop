<?php

namespace App\Contracts;

interface InventoryContract
{
    public function listInventories(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createInventory(array $data);
    public function updateInventory(array $data, string $id);
    public function getInventory(array $with = [], string $id);
    public function deleteInventory(string $id);
    public function getSelectedInventory(string $source_stock_ids);
    public function getInventories(object $request);
}