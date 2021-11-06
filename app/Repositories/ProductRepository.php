<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProducts(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProduct(array $data)
    {
        dd($data);

        $product = new Product($data);

        return $product;
    }

}