<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductVariant;
use App\Models\ProductOption;
use Illuminate\Support\Arr;
use App\Contracts\ProductOptionContract;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductOptionRepository extends BaseRepository implements ProductOptionContract
{
    public function __construct(ProductOption $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProductOptions(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProductOption(array $data)
    {
        $productOption = new ProductOption($data);
        $productOption->save();

        return $productOption;
    }

    public function updateProductOption(array $data, string $id) {
        
        $productOption = $this->find([], $id);

        isset($data['optionValue_ids']) ? $data['optionValue_ids'] = $data['optionValue_ids'] : $data['optionValue_ids'] = null;

        $productOption->update([
            'optionValue_ids' => $data['optionValue_ids'],
            'code' => $data['code'],
            'name' => $data['name'],
        ]);

        return $productOption;
    }

    public function getProductOption(array $with = [], string $id) {
        return $this->find($with, $id);
    }

    public function getProductOptions(object $request) {
        
        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;        
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        //dd($this->model);
        if(empty($request->input('search.value'))) {
            $productOption_data = $this->model->with('values')->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $search_text = $request->input('search.value');
            $productOption_data = $this->model->with('values')
            ->where('_id', $search_text)
            ->orWhere('name', 'like', "%{$search_text}%")
            ->orWhere('code', 'like', "%{$search_text}%")
            ->orWhereHas('values', function($query) use ($search_text){
                $query->where('value', 'like', "%{$search_text}%");
            })
            ->skip(intval($start_val))
            ->take(intval($limit_val))
            ->orderBy('id', 'asc')
            ->get();
            
            $totalFilteredRecord = count($productOption_data);
        }
        //dd($product_data);
        $data_val = [];
        if(!empty($productOption_data)) {
            foreach ($productOption_data as $productOption_val) {
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);
                
                $productOptionNestedData['id'] = $productOption_val->id;
                $productOptionNestedData['name'] = $productOption_val->name;
                
                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productOptionNestedData['options'] = "&emsp;<a href='".route('admin.catalog.options.edit', ['id' => $productOption_val->id])."' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'><span class='showdata glyphicon glyphicon-list'>UREDI</span></a>&emsp;<a href='".route('admin.catalog.options.delete', ['id' => $productOption_val->id])."' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded' onclick=\"return confirm('Sigurno želite obrisati opciju?')\"><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
                $data_val[] = $productOptionNestedData;
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

    public function deleteProductOptions(string $id)
    {
        $option = $this->find(['values'], $id);

        $option->values()->delete();

        $this->delete($id);
    }

    // geting options for filter on category site just if product has that option and not displaying all options! 
    public function getOptionsFromProducts(object $products = null, object $variants = null, object $single = null) : object
    {
        $option_ids_from_products = [];

        if ($products !== null) {
            $option_ids_from_products[] = $this->fillOptionIds($products);
        }

        if ($variants !== null) {
            $option_ids_from_products[] = $this->fillOptionIds($variants);
        }

        if ($single !== null) {
            if ($single->product) { // if variant
                $option_ids_from_products[] = $this->fillOptionIdsForOneProduct($single->product);
            } else { // if unique product
                $option_ids_from_products[] = $this->fillOptionIdsForOneProduct($single);
            }
        }

        $option_ids_filtered = [];
        foreach ($option_ids_from_products as $key => $value) {
            foreach ($value as $key => $value) {
                $option_ids_filtered[] = $value;
            }
        }
        // get option_values ids from product
        
        $options = ProductOption::query()->with(['values']);
        if ($single !== null) {
            $options->with(['values' => function ($query) use ($single){
                $query->whereIn('_id', (array)$single->optionValue_ids);
            }]);
        }
        $options->whereIn('_id', $option_ids_filtered);

        $options = $options->get();

        return $options;
    }


    public function getOptionsWithSomeValues(array $optionValue_ids = []) {
        $options = ProductOption::query();
            $options->with(['values' => function ($query) use ($optionValue_ids){
                $query->whereIn('_id', (array)$optionValue_ids);
            }]);
        
        $options = $options->get();
        $opt = [];
        foreach ($options as $key) {
            if(count($key->values) > 0) {
                array_push($opt, $key);
            }
        }
        
        return $opt;
    }

    private function fillOptionIds(object $products_or_variants) : array
    {
        $option_ids_from_products = [];
     
       
                foreach ($products_or_variants as $product_or_variant) {
                    if (isset($product_or_variant->option_ids)) {
                        if ($product_or_variant->option_ids !== "" || is_array($product_or_variant->option_ids)) {
                            if (count($product_or_variant->option_ids) > 0) {
                                foreach($product_or_variant->option_ids as $option_id) {
                            
                                    if (!in_array($option_id, $option_ids_from_products)) {
                            
                                        $option_ids_from_products[] = $option_id;
                            
                                    }
                            
                                }
                    
                            }
                        }
                    }                    
                }

        return $option_ids_from_products;
    }

    private function fillOptionIdsForOneProduct(object $product)
    {
        $option_ids_from_products = [];     
        if ($product->option_ids !== "" || is_array($product->option_ids)) {
            if ($product->option_ids !== null) {
                if (count($product->option_ids) > 0) {
                    foreach($product->option_ids as $option_id) {
                
                        if (!in_array($option_id, $option_ids_from_products)) {
                
                            $option_ids_from_products[] = $option_id;
                
                        }
                
                    }

                }
            }
        }
        
        return $option_ids_from_products;
    }
}