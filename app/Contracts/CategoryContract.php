<?php

namespace App\Contracts;

interface CategoryContract
{
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);
}