<?php

namespace App\Contracts;

interface ProductContract
{
    public function listProducts(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    //public function createCategory(array $data);
    //public function updateCategory(array $data, string $id);
    //public function getCategory(array $with = [], string $id);
    //public function deleteCategory(string $id);
}