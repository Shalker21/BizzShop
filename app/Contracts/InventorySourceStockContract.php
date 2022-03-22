<?php

namespace App\Contracts;

interface InventorySourceStockContract
{
    public function listInventorySourceStocks(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createInventorySourceStock(array $data);
    public function updateInventorySourceStock(array $data, string $id);
    public function getInventorySourceStock(array $with = [], string $id);
    public function deleteInventorySourceStock(string $id);
    public function getSelectedInventorySourceStock(string $category_ids);
    public function getInventorySourceStocks(object $request);
}