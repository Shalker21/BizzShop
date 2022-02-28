<?php

namespace App\Contracts;

interface ProductAttributeContract
{
    public function listProductAttributes(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProductAttribute(array $data);
    public function getProductAttributes(object $request);
    public function updateProductAttribute(array $data, string $id);
    public function getProductAttribute(array $with = [], string $id);
    public function deleteProductAttribute(string $id);
}