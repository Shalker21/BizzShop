<?php

namespace App\Contracts;

interface ProductImageContract
{
    public function createImageProduct(array $data, string $id, string $folder = null, string $disk = 'public', string $filename = null);
    public function updateImageProduct(array $data, string $id);
    public function deleteImageProduct(array $data, string $disk);
}