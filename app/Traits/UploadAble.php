<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait UploadAble
{
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        // returns path
        return $file->storeAs(
            $folder,
            $name, //$file->getClientOriginalExtension(), we don't need extention because we got it in originalName
            $disk
        );
    }

    public function deleteOne($path = null, $disk = 'public')
    {
        return Storage::disk($disk)->delete($path);
    }   
}   