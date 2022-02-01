<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class, 'index'])->name('blog');
Route::get('/home', [BlogController::class, 'index'])->name('blog');
Route::get('/new', [BlogController::class, 'create'])->name('blog.new');
Route::post('/new', [BlogController::class, 'store'])->name('blog.new');
Route::get('/detail', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/show/{id?}', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/update/{id}', [BlogController::class, 'edit'])->name('blog.update');
Route::post('/update', [BlogController::class, 'update'])->name('blog.update');
Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');


Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');