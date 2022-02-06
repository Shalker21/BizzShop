<?php

namespace App\Contracts;

interface ProductOptionValueContract
{
    public function listOptionValues(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createOptionValues(array $data);
    public function getOptionValues(object $request);
}