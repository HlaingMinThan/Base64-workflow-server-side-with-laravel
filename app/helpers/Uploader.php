<?php

namespace App\helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Uploader
{
    function uploadBase64($base64_string, $folderName, $fileName = null)
    {
        $path = public_path($folderName);
        $fileName = ($fileName ?? Str::random(10))  . '.jpg';
        //create path if it doesn't exists
        File::makeDirectory($path, 0777, true, true);
        $file = fopen($path . '/' . $fileName, "wb");
        [$inital, $endodedString] = explode(',', $base64_string);
        fwrite($file, base64_decode($endodedString));
        fclose($file);
        return asset($folderName . '/' . $fileName);
    }
}
