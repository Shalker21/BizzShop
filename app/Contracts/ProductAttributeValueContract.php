<?php

namespace App\Contracts;

interface ProductAttributeValueContract
{
    public function listProductAttributeValues(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProductAttributeValue(array $data);
    public function getProductAttributeValues(object $request);
    public function updateProductAttributeValue(array $data, string $id);
    public function getProductAttributeValue(array $with = [], string $id);
    public function deleteProductAttributeValue(string $id);
}