<?php

namespace App\Repositories;

use App\Traits\UploadAble;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductTranslation;
use Illuminate\Support\Arr;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;
use App\Models\Category;
use App\Models\InventorySourceStock;
use App\Models\ProductVariantStockItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon as SupportCarbon;

/**
 * Class BrandRepository
 *
 * @package \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    public $products;
    public $variants;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProducts(int $perPage = 25, array $with = [], array $columns = ['*'], string $order = 'id', string $sort = 'asc')
    {
        return $this->all($perPage, $with, $columns, $order, $sort);
    }

    public function createProduct(array $data)
    {
        
        isset($data['enabled']) ? ($data['enabled'] == "on" ? $data['enabled'] = true : $data['enabled'] = false) : false;

        //$data['category_ids'] = explode(",", $data['category_ids']);
        $data['quantity_total'] = $data['quantity_total'] === '0' ? $data['enabled'] = false : (int)$data['quantity_total'];
        if (isset($data['no_variant']) && $data['no_variant'] === 'on') {
            $data['no_variant'] = true;
        } else {
            $data['no_variant'] = false; 
        }
        $product = new Product($data);
        $product->save();

        $productTranslation = new ProductTranslation($data);
        $product->product_translation()->save($productTranslation);
        //dd($data);
        if ($data['no_variant']) {
            $data['product_id'] = $product->id;
            $data['variant_id'] = null;
            $data['unit_price'] = (float)$data['unit_price'];
            $data['quantity'] = $data['quantity_total'];
            if (isset($data['unit_special_price'])) {
                $data['unit_special_price'] = (float)$data['unit_special_price'];
            }
            $productStockItem = new ProductVariantStockItem($data);
            $product->stock_item()->save($productStockItem);
        }

        if (isset($data['inventory_ids'])) {
            foreach ($data['inventory_ids'] as $inventory_id) {
                $data['code'] = Carbon::now()->toString();
                $data['stock'] = $product->quantity_total;

                $inventorySourceStock = new InventorySourceStock([
                    'product_id' => $product->id,
                    'variant_id' => null,
                    'inventory_id' => $inventory_id,
                    'code' => $data['code'],
                    'stock' => $data['stock'],
                ]);

                $inventorySourceStock->save();
            }
        }

        return $product;
    }

    public function updateProduct(array $data, string $id)
    {
        isset($data['enabled']) ? ($data['enabled'] == "on" ? $data['enabled'] = true : $data['enabled'] = false) : false;

        $data['quantity_total'] = $data['quantity_total'] === '0' ? $data['enabled'] = false : (int)$data['quantity_total'];
        
        if (isset($data['no_variant']) && $data['no_variant'] === 'on') {
            $data['no_variant'] = true;
        } else {
            $data['no_variant'] = false; 
        }

        $product = $this->findOne($id);

        $product->category_ids = isset($data['category_ids']) ? $data['category_ids'] : '';
        $product->variant_ids = isset($data['variant_ids']) ? $data['variant_ids'] : '';
        $product->option_ids = isset($data['option_ids']) ? $data['option_ids'] : '';
        $product->optionValue_ids = isset($data['optionValue_ids']) ? $data['optionValue_ids'] : '';
        $product->attribute_ids = isset($data['attribute_ids']) ? $data['attribute_ids'] : '';
        $product->attributeValue_ids = isset($data['attributeValue_ids']) ? $data['attributeValue_ids'] : '';
        $product->brand_id = isset($data['brand_id']) ? $data['brand_id'] : '';
        $product->code = isset($data['code']) ? $data['code'] : '';
        $product->quantity_total = isset($data['quantity_total']) ? $data['quantity_total'] : '';
        $product->enabled = isset($data['enabled']) ? ($data['quantity_total'] !== '0' ? true : false) : '';
        $product->width = isset($data['width']) ? $data['width'] : '';
        $product->height = isset($data['height']) ? $data['height'] : '';
        $product->depth = isset($data['depth']) ? $data['depth'] : '';
        $product->weight = isset($data['weight']) ? $data['weight'] : '';
        $product->no_variant = $data['no_variant'];

        $product->product_translation->name = isset($data['name']) ? $data['name'] : '';
        $product->product_translation->slug = isset($data['slug']) ? $data['slug'] : '';
        $product->product_translation->description = isset($data['description']) ? $data['description'] : '';
        $product->product_translation->short_description = isset($data['short_description']) ? $data['short_description'] : '';
        $product->product_translation->meta_keywords = isset($data['meta_keywords']) ? $data['meta_keywords'] : '';
        $product->product_translation->meta_description = isset($data['meta_description']) ? $data['meta_description'] : '';

        if ($data['no_variant']) {
            if ((float)$data['unit_price'] > 0) {
                if ($product->stock_item !== null) {
                    $product->stock_item->variant_id = null;
                    $product->stock_item->product_id = $product->id;
                    $product->stock_item->quantity = isset($data['quantity_total']) ? $data['quantity_total'] : '';
                    $product->stock_item->unit_price = isset($data['unit_price']) ? (float)$data['unit_price'] : '';
                    $product->stock_item->unit_special_price = isset($data['unit_special_price']) ? (float)$data['unit_special_price'] : '';
                    $product->stock_item->unit_special_price_from = isset($data['unit_special_price_from']) ? $data['unit_special_price_from'] : '';
                    $product->stock_item->unit_special_price_to = isset($data['unit_special_price_to']) ? $data['unit_special_price_to'] : '';
                    $product->stock_item->width_measuring_unit_option_value_id = isset($data['width_measuring_unit_option_value_id']) ? $data['width_measuring_unit_option_value_id'] : '';
                    $product->stock_item->height_measuring_unit_option_value_id = isset($data['height_measuring_unit_option_value_id']) ? $data['height_measuring_unit_option_value_id'] : '';
                    $product->stock_item->depth_measuring_unit_option_value_id = isset($data['depth_measuring_unit_option_value_id']) ? $data['depth_measuring_unit_option_value_id'] : '';
                    $product->stock_item->weight_measuring_unit_option_value_id = isset($data['weight_measuring_unit_option_value_id']) ? $data['weight_measuring_unit_option_value_id'] : '';
                    $product->variant_ids = ''; // if unit price is set for single, unique product, then variants are not used !! so we "delete" it if there are set in request
                    //$product->stock_item->save();
                } else {
                    $data['product_id'] = $product->id;
                    $data['variant_id'] = null;
                    $productStockItem = new ProductVariantStockItem($data);
                    $product->stock_item()->save($productStockItem);
                }
            }
        } else {
            if ($product->stock_item !== null) {
                $product->stock_item->unit_price = '';
                $product->stock_item->unit_special_price = '';
                $product->stock_item->unit_special_price_from = '';
                $product->stock_item->unit_special_price_to = '';
                $product->stock_item->width_measuring_unit_option_value_id = '';
                $product->stock_item->height_measuring_unit_option_value_id = '';
                $product->stock_item->depth_measuring_unit_option_value_id = '';
                $product->stock_item->weight_measuring_unit_option_value_id = '';
            }
        }

        if (isset($data['inventory_ids'])) {

            $product->inventory_ids = $data['inventory_ids'];
            InventorySourceStock::where('product_id', $product->id)->whereNotIn('inventory_id', $data['inventory_ids'])->delete(); // ako je product_id i inventory_id onda ne brisi, sveo stalo brisi !=

            foreach ($data['inventory_ids'] as $inventory_id) {

                $data['code'] = Carbon::now()->toString();
                $data['stock'] = $product->quantity_total;

                InventorySourceStock::firstOrCreate(
                    [
                        'inventory_id' => $inventory_id,
                    ],
                    [
                        'product_id' => $id,
                        'variant_id' => null,
                        'inventory_id' => $inventory_id,
                        'code' => $data['code'],
                        'stock' => $data['stock'],
                    ]
                );
            }
        } else { // if no inventory is selected then delete source stock if product_id exists in collection
            InventorySourceStock::where('product_id', $product->id)->delete();
            $product->inventory_ids = null;
        }

        //$product->product_translation->save();

        $product->push(); // push is for updating and saving model and its relations

        return $product;
    }

    public function getProduct(array $with = [], string $id)
    {
        return $this->find($with, $id);
    }

    public function get_products(object $request)
    {

        $totalDataRecord = $this->count_all();
        //$totalDataRecord = Product::count(); This is faster but not that fast, need to test on bigger data
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');

        if (empty($request->input('search.value'))) {
            $product_data = $this->model->with('product_translation')->skip(intval($start_val))
                ->take(intval($limit_val))
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $product_data = $this->model->with('product_translation')
                ->where('_id', $search_text)
                ->orWhereHas('product_translation', function ($query) use ($search_text) {
                    $query->where('name', 'like', "%{$search_text}%");
                })
                ->skip(intval($start_val))
                ->take(intval($limit_val))
                ->orderBy('id', 'asc')
                ->get();

            $totalFilteredRecord = count($product_data);
        }

        $data_val = [];
        if (!empty($product_data)) {
            foreach ($product_data as $product_val) {
                //$datashow =  route('posts_table.show',$post_val->id);
                //$dataedit =  route('posts_table.edit',$post_val->id);

                $productnestedData['id'] = $product_val->id;
                $productnestedData['code'] = $product_val->code;
                $productnestedData['name'] = $product_val->product_translation->name;
                $productnestedData['quantity_total'] = $product_val->quantity_total;
                $productnestedData['enabled'] = $product_val->enabled !== true ? 'NE' : "DA";

                //$postnestedData['body'] = substr(strip_tags($post_val->body),0,50).".....";
                //$postnestedData['created_at'] = date('j M Y h:i a',strtotime($post_val->created_at));
                $productnestedData['options'] = "&emsp;<a href='" . route('admin.catalog.products.edit', ['id' => $product_val->id]) . "' class='bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded'>UREDI</span></a>&emsp;<a href='" . route('admin.catalog.products.delete', ['id' => $product_val->id]) . "' class='bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded' onclick=\"return confirm('Sigurno želite obrisati proizvod?')\"><span class='editdata glyphicon glyphicon-edit'>OBRIŠI</span></a>";
                $data_val[] = $productnestedData;
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

    public function deleteProduct(string $id)
    {
        $product = $this->find(['product_translation', 'variants', 'images', 'stock_item', 'attributes', 'attribute_values'], $id);

        $product->product_translation()->delete();

        foreach ($product->images as $product_image) {
            // delete on s3
            $this->deleteOne($product_image->path, 's3');
        }
        // delete in db
        $product->images()->delete();

        foreach ($product->variants as $variant) {

            $variant->variant_translation()->delete();
            $variant->stock_item()->delete();

            foreach ($variant->images as $variant_image) {
                $this->deleteOne($variant_image->path, 's3');
            }

            $variant->images()->delete();
        }

        $product->variants()->delete();
        $product->stock_item()->delete();
        $product->attributes()->delete();
        $product->attribute_values()->delete();

        $this->delete($id);
    }

    // here goes filters function

    public function getProductsByCategory(string $category_id, array $with, int $limit)
    {
        $products = Product::where('category_ids', 'all', [$category_id])->with($with)->paginate($limit);

        return $products;
    }

    public function filterProducts(object $data): object
    {
        $category_id = $data['hidden_category_id'];
        $selectedBrand_ids = $data['selectedBrand_ids'];

        if (
            $data['price_from'] !== null || 
            !empty($data['price_from']) || 
            $data['price_from'] != 0 || 
            $data['price_from'] !== "0"
            ) {
            $data['price_from'] = (float)$data['price_from'];
        }

        if (
            $data['price_from'] === null || 
            empty($data['price_from']) || 
            $data['price_from'] == 0 ||
            $data['price_from'] === "0"
            ) {
            $data['price_from'] = 0.01;
        }

        if (
            $data['price_to'] !== null ||
            !empty($data['price_to']) || 
            $data['price_to'] != 0 || 
            $data['price_to'] !== "0"
            ) {
            $data['price_to'] = (float)$data['price_to'];
        }

        if (
            $data['price_to'] === null ||
            empty($data['price_to']) || 
            $data['price_to'] == 0 || 
            $data['price_to'] === "0"
            ) {
            $data['price_to'] = 9999;
        }
        
        $selectedOptionValues_ids = [];
        if ($data['selectedOptionValues_ids']) {
            foreach ($data['selectedOptionValues_ids'] as $k => $value_id) {
                array_push($selectedOptionValues_ids, $value_id);
            }
        }
        
        // FILTER SINGLE PRODUCTS
        $products = Product::query()->with([
            'product_translation',
            'images',
            'stock_item',
            //'variants',
            //'variants.images', 
            //'variants.variant_translation',
            //'variants.stock_item',
        ]);

        $products->Where('category_ids', 'all', [$category_id]);
        $products->Where('no_variant', true);
        
        if (!empty($data['price_from']) || !empty($data['price_to'])) {

            $products->whereHas('stock_item', function (Builder $query) use ($data) {
                $query->whereBetween('unit_special_price', [$data['price_from'], $data['price_to']]);//[$data['price_from'], $data['price_to']]); 
            });
        }
        
        if (!empty($data['selectedOptionValues_ids'])) {    
            
            $products->whereRaw([
            
                'optionValue_ids' => ['$all' => $selectedOptionValues_ids]
            
            ]);
        }

        if (!empty($selectedBrand_ids)) {    
            
            foreach ($selectedBrand_ids as $key => $brand_id) {
            
                $products->Where('brand_id', $brand_id);
            
            }
        
        }
        
        $this->products = $products->paginate($data['limit']);

        // FILTER VARIANTS
        $variants = ProductVariant::query()->with([
            'variant_translation',
            'stock_item',
            'images',
        ]);

        if (!empty($data['price_from']) || !empty($data['price_to'])) {

            $variants->whereHas('stock_item', function (Builder $query) use ($data) {
                $query->whereBetween('unit_special_price', [$data['price_from'], $data['price_to']])->orWhereBetween('unit_price', [$data['price_from'], $data['price_to']]);//[$data['price_from'], $data['price_to']]); 
            });
        }

        $variants->whereHas('product', function (Builder $query) use ($category_id, $selectedBrand_ids) {
           
            $query->orWhere('category_ids', 'all', [$category_id]);
           
            if (!empty($selectedBrand_ids)) {    
            
                foreach ($selectedBrand_ids as $key => $brand_id) {
                
                    $query->Where('brand_id', $brand_id);
                }
            }
        });
        
        if (!empty($data['selectedOptionValues_ids'])) {    
            
            $variants->whereRaw([
               
                'optionValue_ids' => ['$all' => $selectedOptionValues_ids]
            ]);
        }

        $this->variants = $variants->paginate($data['limit']);

        return $this;
    }

    public function searchProducts(string $search_query)
    {
        // FILTER SINGLE PRODUCTS
        $products = Product::query();

        $products->with([
            'product_translation' => function ($query) use ($search_query){
                return $query->where('name', 'like', "%{$search_query}%");
            },
            'stock_item',
            'variants'  => function ($query) use ($search_query){
                return $query->whereHas('variant_translation', function ($q) use ($search_query){
                    $q->where('name', 'like', "%{$search_query}%");
                });
            },
            'variants.variant_translation',
        ]);
        $products->where(function($query) use ($search_query) {
            $query->where('no_variant', 'on')
            ->whereHas('product_translation', 
            function (Builder $query) use ($search_query) {
            $query->where('name', 'like', "%{$search_query}%");
        });
    });

        $products->orWhereHas('variants.variant_translation', function (Builder $query) use ($search_query) {
            $query->where('name', 'like', "%{$search_query}%");
        });

         $this->products = $products->paginate(10);

        return $this->products;
    }

}