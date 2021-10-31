<?php

namespace App\Contracts;

interface CategoryContract
{
    public function listCategories(array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createCategory(array $data);
    public function updateCategory(array $data);
}