<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait SaveImageTrait
{

    protected function uploadImage($file, $path = '')
    {
        $file_exe = $file->getClientOriginalExtension();
        $new_name = uniqid() . '.' . $file_exe;
        $directory = 'uploads' . '/' . $path;
        $destienation = public_path($directory);
        $file->move($destienation, $new_name);
        return env('APP_URL') . '/' . $directory . '/' . $new_name;
    }

    protected function deleteImage($image_path, $image_record)
    {
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $image_record->delete();
    } 
}
