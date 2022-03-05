<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Contracts\ProductImageContract;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

/**
 * Class ProductAttributeRepository
 *
 * @package \App\Repositories
 */
class ProductImageRepository extends BaseRepository implements ProductImageContract 
{
    use UploadAble;

    public function __construct(ProductImage $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    public function createImageProduct(array $data, string $product_id) {
        foreach ($data as $instance_of_image) {
            if (isset($instance_of_image) && ($instance_of_image instanceof  UploadedFile)) {
                $image = $this->uploadOne($instance_of_image, 'products');
                $productImage = new ProductImage([
                    'product_id' => $product_id,
                    'type' => $instance_of_image->getType(),
                    'path' => $image,
                ]);
            }
        }
        
    }
    public function deleteImageProduct(array $data, string $product_id){}
}