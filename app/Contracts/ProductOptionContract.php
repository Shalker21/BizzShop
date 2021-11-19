<?php

namespace App\Contracts;

interface ProductVariantOptionContract
{
    public function listProductOptions(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProductOption(array $data);
    public function get_product_options(object $request);
}