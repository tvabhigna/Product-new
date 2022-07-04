<?php

namespace App\Classes\Helper;
use App\Models\Product;


use File;
use Illuminate\Support\Facades\Storage;

class CommonUtil
{
    public static function uploadFileToFolder($file, $folder)
    {
        $originalName = Storage::disk('public')->putFile($folder, $file, 'public');
        return $originalName;
    }

       /**
     * Remove File Form Folder
     *
     * @param $path
     *
     * @return bool
     */
    public static function removeFile($path)
    {
        // dd('hello');
    	if(Storage::disk('public')->exists($path)){
		    Storage::disk('public')->delete($path);
	    }
        return true;
    }
}
