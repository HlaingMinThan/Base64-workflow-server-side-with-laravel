<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Str;


function uploadBase64ToImage($base64_string, $path, $fileName)
{
    File::makeDirectory($path, 0777, true, true); //create path if it doesn't exists
    $file = fopen($path . '/' . $fileName, "wb");
    $data = explode(',', $base64_string);
    fwrite($file, base64_decode($data[1]));
    fclose($file);
    return asset('images/' . $fileName);
}

Route::post('/upload', function () {
    $random = Str::random(10);
    return uploadBase64ToImage(
        request('base64'),
        public_path('images'),
        request('name') ??  $random  . '.jpg'
    );
});
