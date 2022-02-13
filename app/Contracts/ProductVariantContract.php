<?php

namespace App\Contracts;

interface ProductVariantContract
{
    public function listProductVariants(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProductVariant(array $data);
    public function updateProductVariant(array $data, string $id);
    public function get_product_variants(object $request);
}