<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Contracts\ProductImageContract;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
    
    public function createImageProduct(array $data, string $id, string $folder = null, string $disk = 'public', string $filename = null) {
        foreach ($data as $instance_of_image) {
            if (
                isset($instance_of_image) &&
                ($instance_of_image instanceof  UploadedFile
            )) {
                //dd($instance_of_image->getClientOriginalName());
                $image = $this->uploadOne($instance_of_image, $folder.'/'.$id, $disk, $instance_of_image->getClientOriginalName());
                $productImage = new ProductImage([
                    'product_id' => $folder === 'products' ? $id : null,
                    'variant_id' => $folder === 'variants' ? $id : null,
                    'type' => $instance_of_image->getType(),
                    'path' => $image,
                ]);
                $productImage->save();
            }
        }
        return true;
    }

    public function updateImageProduct(object $data, string $id, string $folder = null, string $disk = 'public', string $filename = null) {

            if (
                $data->file('file') &&
                ($data->file('file') instanceof  UploadedFile
            )) {
                $file = $data->file('file');
                
                if (isset($data['image_id'])) {
                    $oldImage = $this->find([], $data['image_id']);
                    $this->deleteOne($oldImage->path, 's3');
                    $image = $this->uploadOne($file, $folder.'/'.$id, 's3', $file->getClientOriginalName());
                    $this->delete($data['image_id']);
                    $productImage = new ProductImage([
                        'product_id' => $folder === 'products' ? $id : null,
                        'variant_id' => $folder === 'variants' ? $id : null,
                        'type' => $file->getType(),
                        'path' => $image,
                    ]);
                    $productImage->save();
                } else {
                    $image = $this->uploadOne($file, $folder.'/'.$id, 's3', $file->getClientOriginalName());
                    $productImage = new ProductImage([
                        'product_id' => $folder === 'products' ? $id : null,
                        'variant_id' => $folder === 'variants' ? $id : null,
                        'type' => $file->getType(),
                        'path' => $image,
                    ]);
                    $productImage->save();
                }
                
            }


        // We need to delete images if there is not in array!!

        return true;
    }

    public function deleteImageProduct(array $data, string $disk) {
        $this->delete($data['image_id']);
        return $this->deleteOne($data['path'], $disk);
    }
}