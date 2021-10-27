<?php

namespace App\Repositories;

use App\Models\CategoryTranslation;
use App\Traits\UploadAble;
use App\Models\Category;
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
        dd($data);
    }
}