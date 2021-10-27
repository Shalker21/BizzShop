<?php

namespace App\Contracts;

interface CategoryContract
{
    public function listCategories();
    public function createCategory(array $data);
}