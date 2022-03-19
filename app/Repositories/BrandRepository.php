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

    public function getBrands(object $request) {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $brand_data = $this->model->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get(['id', 'name']);
        } else {
            $search_text = $request->input('search.value');
            $brand_data = $this->model
                ->where('_id', $search_text)
                ->orWhere('name', 'like', "%{$search_text}%")
                ->skip(intval($start_val))
                ->take(intval($limit_val))
                ->orderBy('id', 'asc')
                ->get(['id', 'name']);
            
            $totalFilteredRecord = count($brand_data);
        }

        $data_val = [];
        if(!empty($brand_data)) {
            foreach ($brand_data as $brand_val) {
                
                $brandnestedData['id'] = $brand_val->id;
                $brandnestedData['name'] = $brand_val->name;

                $brandnestedData['options'] = "&emsp;<a href='".route('admin.catalog.brands.edit', ['id' => $brand_val->id])."' class='underline text-blue-600 hover:text-blue-800 visited:text-purple-600'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.brands.delete', ['id' => $brand_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>OBRIŠI</span></a>";
                
                $data_val[] = $brandnestedData;
            }
        }

        $draw_val = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        ];

        echo json_encode($get_json_data);
    }

    public function getBrand(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function createBrand(array $data)
    {
        // save brand image
        if (Arr::exists($data, 'brand_image') && ($data['brand_image'] instanceof  UploadedFile)) {
            $image = $this->uploadOne($data['brand_image'], 'brands', 's3', $data['brand_image']->getClientOriginalName());
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
            $this->deleteOne($brand->logo_path, 's3');
            $image = $this->uploadOne($data['brand_image'], 'brands', 's3', $data['brand_image']->getClientOriginalName());
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

        if ($brand->logo_path != null) {
            $this->deleteOne($brand->logo_path, 's3');
        }
        return $this->delete($id);   
    }
}