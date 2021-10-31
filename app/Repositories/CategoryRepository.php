<?php

namespace App\Repositories;

use App\Models\CategoryTranslation;
use App\Traits\UploadAble;
use App\Models\Category;
use App\Models\CategoryImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use App\Contracts\CategoryContract;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listCategories(array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'desc') {
        return $this->all($with, $columns, $order, $sort);
    }

    public function getCategory(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function updateCategory(array $data)
    {
        
    }

    public function createCategory(array $data) {
        
        $featured = Arr::exists($data, 'featured') ? true : false;
        $menu = Arr::exists($data, 'menu') ? true : false;
        $data['featured'] = $featured;
        $data['menu'] = $menu;

        $category = new Category($data);
        $category->save();

        // save category data like name, desc...
        $categoryTranslation = new CategoryTranslation($data);
        $category->category_translation()->save($categoryTranslation);
        
        // save category image
        if (Arr::exists($data, 'category_image') && ($data['category_image'] instanceof  UploadedFile)) {
            $image = $this->uploadOne($data['category_image'], 'categories');
            $categoryImage = new CategoryImage([
                'path'      =>  $image,
            ]);
            $category->category_image()->save($categoryImage);
        }
        return $category;
    }
}