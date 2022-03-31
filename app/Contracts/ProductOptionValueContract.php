<?php

namespace App\Contracts;

interface ProductOptionValueContract
{
    public function listOptionValues(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc');
    public function createOptionValues(array $data);
    public function getOptionValue(array $with = [], string $id);
    public function updateOptionValues(array $data, string $id);
    public function getOptionValues(object $request);
    public function getOptionValuesFromGivenOptions(object $options, object $product);
    public function deleteOptionValues(string $id);
}