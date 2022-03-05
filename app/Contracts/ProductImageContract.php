<?php

namespace App\Contracts;

interface ProductImageContract
{
    public function createImageProduct(array $data, string $product_id);
    public function deleteImageProduct(array $data, string $product_id);
}