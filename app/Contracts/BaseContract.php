<?php

namespace App\Contracts;

interface BaseContract
{
    public function create (array $attributes);
    public function update (array $attributes, int $id);
    public function all (array $with, $columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');
    public function find (string $id);
    public function findOneOrFail (int $id);
    public function findBy (array $data);
    public function findOneBy (array $data);
    public function findOneByOrFail (array $data);
    public function delete (int $id);
}