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

    public function getBrand(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function createBrand(array $data)
    {
        //dd($data);
        // save brand image
        if (Arr::exists($data, 'brand_image') && ($data['brand_image'] instanceof  UploadedFile)) {
            $image = $this->uploadOne($data['brand_image'], 'brands');
            $data['logo_path'] = $image;
        }
        
        $data['slug'] = strtolower($data['name']);
        unset($data['brand_image']); // don't need this in database anyway so why to pass object in brand instance.. 
        $brand = new Brand($data);
        $brand->save();

        return $brand;
    }

    public function updateBrand(array $data)
    {
        $brand = $this->find([], $data['id']);
        // update brand image
        if (Arr::exists($data, 'brand_image') && ($data['brand_image'] instanceof  UploadedFile)) {
            $this->deleteOne($brand->logo_path);
            $image = $this->uploadOne($data['brand_image'], 'brands');
            $data['logo_path'] = $image;
            $brand->update(['logo_path' => $data['logo_path']]);
        }

        unset($data['brand_image']);

        $data['slug'] = strtolower($data['name']);
        $brand->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);

        return $brand;
    }

    public function deleteBrand(string $id) {
        $brand = $this->find([], $id);

        if ($brand->brand_image != null) {
            $this->deleteOne($brand);
        }
        $this->delete($id);   
        
        return $brand;
    }
}