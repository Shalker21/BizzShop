<?php

namespace App\Contracts;

interface ProductOptionContract
{
    public function listProductOptions(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProductOption(array $data);
    public function getProductOption(array $with = [], string $id);
    public function updateProductOption(array $data, string $id);
    public function getProductOptions(object $request);
    public function deleteProductOptions(string $id);
    public function getOptionsFromProducts(object $products = null, object $variants = null, object $single = null);
    public function getOptionsWithSomeValues(array $productOption_ids = []);
}