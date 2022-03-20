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
    public function getInventorySourceStocks(object $request) {}
}
