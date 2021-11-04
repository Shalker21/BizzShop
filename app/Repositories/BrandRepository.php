<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use App\Models\Brand;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use App\Contracts\BrandContract;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class BrandRepository extends BaseRepository implements BrandContract
{
    use UploadAble;

    public function __construct(Brand $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listBrands(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createBrand(array $data)
    {
        dd($data);
        // save brand image
        if (Arr::exists($data, 'brand_image') && ($data['brand_image'] instanceof  UploadedFile)) {
            $image = $this->uploadOne($data['brand_image'], 'brands');
        }
        $data['logo_path'] = $image;
        dd($data);
        $brand = new Brand($data);
        $brand->save();

        return $brand;
    }
}