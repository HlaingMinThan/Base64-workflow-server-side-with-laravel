<?php

use App\helpers\Uploader;
use Illuminate\Support\Facades\Route;

Route::post('/upload', function () {
    $uploader = new Uploader();
    return $uploader->uploadBase64(request('base64'), 'images');
});
