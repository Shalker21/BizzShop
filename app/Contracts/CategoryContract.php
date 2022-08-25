<?php

namespace App\Contracts;

interface CategoryContract
{
    public function listCategories(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createCategory(array $data);
    public function updateCategory(array $data, string $id);
    public function getCategory(array $with = [], string $id);
    public function deleteCategory(string $id);
    public function getSelectedCategories(string $category_ids);
    public function getCategories(object $request);
    public function getRoot(array $with = [], string $id = '63079f4cd55971252a63bf74');

}