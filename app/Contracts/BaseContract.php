<?php

namespace App\Contracts;

interface BaseContract
{
    public function create (array $attributes);
    public function update (array $attributes, string $id);
    public function all (int $perPage = 25, array $with, $columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');
    public function find (array $with, string $id);
    public function findOne (string $id);
    public function findBy (array $data, array $with, int $limit);
    public function findOneBy (array $data);
    public function findOneByOrFail (array $data);
    public function delete (string $id);
    public function count_all();
}