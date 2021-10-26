<?php 

namespace App\BaseRepositories;

use App\Models\Category;
use App\Treats\UploadAble;
use App\Contracts\BaseContract;
use App\Contracts\CategoryContract;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseContract implements CategoryContract
{
    protected $model;

    public function __construct(Category $model) {
        parent::__construct($model);
        $this->model = $model;
    }

    
}