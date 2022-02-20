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

    public function getCategories(object $request) {
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        
        if(empty($request->input('search.value'))) {
            $category_data = $this->model->with('category_translation', 'category_breadcrumbs')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $category_data = $this->model->with('category_translation', 'category_breadcrumbs')
            ->where('_id', $search_text)
            ->orWhereHas('category_translation', function($query) use ($search_text){
                $query->where('name', 'like', "%{$search_text}%");
            })
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($category_data);
        }

        $data_val = [];
        if(!empty($category_data)) {
            foreach ($category_data as $category_val) {
                
                $categorynestedData['id'] = $category_val->id;
                $categorynestedData['name'] = $category_val->category_translation->name;

                $last_space_position = strrpos($category_val->category_breadcrumbs->breadcrumb, '/');
                $text_without_last_word = substr($category_val->category_breadcrumbs->breadcrumb, 0, $last_space_position);
                $categorynestedData['parent'] = $text_without_last_word . '&nbsp;&nbsp;</p><small>(' . $category_val->parent_id . ')</small>';
                
                $categorynestedData['featured'] = $category_val->featured ? 'DA' : 'NE';
                $categorynestedData['menu'] = $category_val->menu ? 'DA' : 'NE';
                $categorynestedData['options'] = $category_val->category_translation->name !== 'Root' ? "&emsp;<a href='".route('admin.catalog.categories.edit', ['id' => $category_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.categories.edit', ['id' => $category_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded'>OBRIŠI</span></a>" : "";
                
                $data_val[] = $categorynestedData;
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

    public function getSelectedCategories(string $category_ids) {
        $categories = $this->listCategories(0, ['category_translation', 'category_breadcrumbs']);
        // treba usporediti id od spremljenih idova u category_ids 
        
        $cat_ids = $category_ids;
        $cat_ids = substr($cat_ids, 2);
        $cat_ids = substr($cat_ids, 0, -2);
        $cat_ids = explode(",", $cat_ids);

        $selectedCategories = [];
        foreach ($cat_ids as $cat_id) {
            array_push(
                $selectedCategories,
                Category::with([
                    'category_translation',
                    'category_breadcrumbs'
                    ])
                    ->where('_id', $cat_id)
                    ->get());
        }

        return $selectedCategories;
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
        $category = $this->find(['category_translation', 'category_breadcrumbs','category_image'], $id);
        
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

        //dd($category->category_translation->name);

        $old_category_name = $category->category_translation->name;
        $new_category_name = $data['name'];
        $c = CategoryBreadcrumbs::where('breadcrumb', 'like', '%' . $category->category_translation->name . '%')
        ->get()
        ->map(function ($item) use ($old_category_name, $new_category_name) {
            $item->update([
                'breadcrumb' => str_replace($old_category_name, $new_category_name, $item->breadcrumb),
            ]);
        });

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