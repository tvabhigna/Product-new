<?php

namespace App\Classes\Helper;
use App\Models\Product;


use File;
use Illuminate\Support\Facades\Storage;

class CommonUtil
{
    public static function uploadFileToFolder($file, $folder)
    {
        $destinationPath = Storage::disk('public')->path($folder);
        $url = Storage::disk('public')->putFile($folder, $file, 'public');
        $originalUrl = Storage::disk('public')->url($url);

        // $originalName = Storage::disk('DO')->putFile($folder, $file, 'public');
        $originalName = Storage::disk('public')->putFile($folder, $file, 'public');

        return $originalName;


       
    }
}
// $destinationPath = Storage::disk('public')->path($folder);
// $url = Storage::disk('public')->putFile($folder, $file, 'public');
// $originalUrl = Storage::disk('public')->url($url);
// $originalName = Storage::disk('public')->putFile('images', $request->file('image'));

