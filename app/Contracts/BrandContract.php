<?php

namespace App\Contracts;

interface BrandContract
{
    public function listBrands(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createBrand(array $data);
    public function updateBrand(array $data);
    public function getBrand(array $with = [], string $id);
    public function deleteBrand(string $id);
}