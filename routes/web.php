<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ImageUpload;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


// Route::get('/image-upload', ImageUpload::class)->middleware('auth');
Route::get('/image-upload', function () {
    return view('livewire.image-upload');
});