<?php

namespace App\Repositories;

use App\Models\CategoryTranslation;
use App\Traits\UploadAble;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use App\Contracts\CategoryContract;
use Illuminate\Support\Arr;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class CategoryRepository extends BaseRepository implements CategoryContract
{
    use UploadAble;
    protected $model;
    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listCategories() {
        return Category::with('category_translation')->get();
    }

    public function createCategory(array $data) {

        if (Arr::exists($data, 'image') && ($data['image'] instanceof  UploadedFile)) {
            $image = $this->uploadOne($data['image'], 'categories');
        }

        $featured = Arr::exists($data, 'featured') ? true : false;
        $menu = Arr::exists($data, 'menu') ? true : false;
        $data['featured'] = $featured;
        $data['menu'] = $menu;

        // Maybe using transactions ?? digging deapper what transactions is !!
        $category = new Category($data);
        $category->save();
        $categoryTranslation = new CategoryTranslation($data);
        $category->category_translation()->save($categoryTranslation);

        return $category;
    }
}