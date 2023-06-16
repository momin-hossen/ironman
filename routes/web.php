<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// FrontendController
Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('about', [FrontendController::class, 'about'])->name('about');


// CategoryController
Route::get('add/category', [CategoryController::class, 'addcategory']);
Route::post('add/category/post', [CategoryController::class, 'addcategorypost']);
Route::get('delete/category/{category_id}', [CategoryController::class, 'deletecategory']);
Route::get('edit/category/{category_id}', [CategoryController::class, 'editcategory']);
Route::post('edit/category/post', [CategoryController::class, 'editcategorypost']);
Route::get('restore/category/{category_id}', [CategoryController::class, 'restorecategory']);
Route::get('force/delete/category/{category_id}', [CategoryController::class, 'forcedeletecategory']);
Route::post('mark/delete', [CategoryController::class, 'markdelete']);


// ProfileController
Route::get('profile', [ProfileController::class, 'profile']);
Route::post('edit/profile/post', [ProfileController::class, 'editprofilepost']);
Route::post('edit/password/post', [ProfileController::class, 'editpasswordpost']);


// HomeController
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
