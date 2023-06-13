<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('about', [FrontendController::class, 'about'])->name('about');


Route::get('add/category', [CategoryController::class, 'addcategory']);
Route::post('add/category/post', [CategoryController::class, 'addcategorypost']);
Route::get('delete/category/{category_id}', [CategoryController::class, 'deletecategory']);
Route::get('edit/category/{category_id}', [CategoryController::class, 'editcategory']);
Route::post('edit/category/post', [CategoryController::class, 'editcategorypost']);
Route::get('restore/category/{category_id}', [CategoryController::class, 'restorecategory']);
Route::get('force/delete/category/{category_id}', [CategoryController::class, 'forcedeletecategory']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
