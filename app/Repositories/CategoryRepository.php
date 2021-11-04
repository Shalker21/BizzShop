<?php

namespace App\Repositories;

use App\Models\CategoryTranslation;
use App\Models\CategoryBreadcrumbs;
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

    public function listCategories(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'desc') {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function getCategory(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function createCategory(array $data) {
        $featured = Arr::exists($data, 'featured') ? true : false;
        $menu = Arr::exists($data, 'menu') ? true : false;
        $data['featured'] = $featured;
        $data['menu'] = $menu;
        $data['slug'] = strtolower($data['name']);
        $data['breadcrumb_id'] = explode("|", $data['parent_id']);
        $data['parent_id'] = $data['breadcrumb_id'][0];
        $data['breadcrumb_id'] = $data['breadcrumb_id'][1];
        
        $categoryBreadcrumb = CategoryBreadcrumbs::with('category')->where('_id', $data['breadcrumb_id'])->first();
        
        $data['breadcrumb'] = $categoryBreadcrumb->breadcrumb."/".$data['name']; 
        
        $category = new Category($data);
        $category->save();

        $categoryBreadcrumb = new CategoryBreadcrumbs($data);
        $category->category_breadcrumbs()->save($categoryBreadcrumb);

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

    public function updateCategory(array $data, string $id) {
        $category = $this->find(['category_translation', 'category_image'], $id);
        
        $featured = Arr::exists($data, 'featured') ? true : false;
        $menu = Arr::exists($data, 'menu') ? true : false;
        $data['featured'] = $featured;
        $data['menu'] = $menu;

        $data['breadcrumb_id'] = explode("|", $data['parent_id']);
        $data['parent_id'] = $data['breadcrumb_id'][0];
        $data['breadcrumb_id'] = $data['breadcrumb_id'][1];
        
        $categoryBreadcrumb = CategoryBreadcrumbs::with('category')->where('_id', $data['breadcrumb_id'])->first();
        if ($data['parent_id'] === $category->id) {
            $data['breadcrumb'] = $categoryBreadcrumb->breadcrumb;  
        } else {
            $data['breadcrumb'] = $categoryBreadcrumb->breadcrumb."/".$data['name']; 
        }
        unset($data['breadcrumb_id']);
        
        //dd($data);

        $category->update([
            'parent_id' => $data['parent_id'],
            'featured' => $data['featured'],
            'menu' => $data['menu'],
        ]);

        $category->category_translation()->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $category->category_breadcrumbs()->update([
            //'breadcrumb_id' => $data['breadcrumb_id'],
            'breadcrumb' => $data['breadcrumb'],
        ]);

        if (Arr::exists($data, 'category_image') && ($data['category_image'] instanceof  UploadedFile)) {
            if ($category->category_image != null) { // if image exists
                $this->deleteOne($category->category_image->path); // delete image from storage/categories
                $image = $this->uploadOne($data['category_image'], 'categories');
                $category->category_image()->update(['path' => $image]); 
            } else {
                $image = $this->uploadOne($data['category_image'], 'categories');
                $categoryImage = new CategoryImage([ // if image don't exists we need to create new instance
                    'path'      =>  $image,
                ]);
                $category->category_image()->save($categoryImage);
            }
        }

        return $category;
    }

    public function deleteCategory(string $id) {
        $category = $this->find(['category_translation', 'category_image', 'category_breadcrumbs'], $id);

        if ($category->category_image != null) {
            $this->deleteOne($category);
        }
        $this->delete($id);   
        $category->category_image()->delete();
        $category->category_translation()->delete();
        $category->category_breadcrumbs()->delete();
        
        return $category;
    }

    // I didn't folow laravel docs, it query every parent but not with eager loading!! so it slows down app and render to many queries!!!
    // PROBLEM SOLVED: not good aproach but it works like sharm, I created database breadcrumbs and just put everything there! 
    /*protected function recCategories(array $with = []) {
        
        foreach ($this->all($with) as $category) {
            $parent = $category; 
            $this->get_hierarchy_categories[$category->id] = $category->category_translation->name; 
            while (!is_null($parent->parent)) {
                $this->get_hierarchy_categories[$category->id] = $parent->parent->category_translation->name.' / '.$this->get_hierarchy_categories[$category->id];
                $parent = $parent->parent;
            }
        }

        return $this->get_hierarchy_categories;
    }*/
}