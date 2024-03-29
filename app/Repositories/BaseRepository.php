<?php 

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\BaseContract;
use Jenssegers\Mongodb\Eloquent\Model;

class BaseRepository implements BaseContract
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, string $id) : bool {
        return $this->find([], $id)->update($attributes);
    }

    public function all(int $perPage = 25, array $with = [], $columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') {
        if ($this->model instanceof Product) {
            if (empty($with)) {
                return $this->model->orderBy($orderBy, $sortBy)->where('enabled', true)->get($columns);
            } elseif ($perPage == 0) {
                return $this->model->with($with)->orderBy($orderBy, $sortBy)->where('enabled', true)->get($columns);
            }
            return $this->model->with($with)
                ->orderBy($orderBy, $sortBy)
                ->where('enabled', true)
                ->paginate($perPage, $columns);
        } else {
            if (empty($with)) {
                return $this->model->orderBy($orderBy, $sortBy)->get($columns);
            } elseif ($perPage == 0) {
                return $this->model->with($with)->orderBy($orderBy, $sortBy)->get($columns);
            }
            return $this->model->with($with)
                ->orderBy($orderBy, $sortBy)
                ->paginate($perPage, $columns);
        }
    }

    public function find(array $with = [], string $id) {
        if (empty($with)) {
            return $this->model->find($id);
        }
        return $this->model->with($with)->find($id);
        
    }

    public function findOne(string $id) {
        return $this->model->find($id);
    }

    public function findBy(string $data, array $with = [], int $limit) {
        return $this->model->where($data)->with($with)->paginate($limit);
    }

    public function findOneBy(array $data) {
        return $this->model->where($data)->first();
    }

    public function findOneByOrFail(array $data) {
        return $this->model->where($data)->firstOrFail();
    }

    public function delete(string $id) : bool {
        return $this->model->find($id)->delete();
    }

    public function count_all()
    {
        return $this->model->count();
    }
}