<?php

namespace App\Contracts;

interface ProductContract
{
    public function listProducts(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createProduct(array $data);
    public function get_products(object $request);
    public function updateProduct(array $data, string $id);
    public function getProduct(array $with = [], string $id);
    public function deleteProduct(string $id);
    public function getProductsByCategory(string $category_id, array $with, int $limit);
    public function filterProducts(object $data);
    public function searchProducts(string $search_query);
}