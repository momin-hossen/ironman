<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('product/details/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('contact/insert', [FrontendController::class, 'contactinsert'])->name('contactinsert');
Route::get('about', [FrontendController::class, 'about'])->name('about');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('customer/register', [FrontendController::class, 'customerregister'])->name('customerregister');
Route::post('customer/register/post', [FrontendController::class, 'customerregisterpost'])->name('customerregisterpost');
Route::post('review/post', [FrontendController::class, 'reviewpost'])->name('review.post');


// CategoryController
Route::get('add/category', [CategoryController::class, 'addcategory']);
Route::post('add/category/post', [CategoryController::class, 'addcategorypost']);
Route::post('delete/category', [CategoryController::class, 'deletecategory']);
Route::get('edit/category/{category_id}', [CategoryController::class, 'editcategory']);
Route::post('edit/category/post', [CategoryController::class, 'editcategorypost']);
Route::get('restore/category/{category_id}', [CategoryController::class, 'restorecategory']);
Route::get('force/delete/category/{category_id}', [CategoryController::class, 'forcedeletecategory']);
Route::post('mark/delete', [CategoryController::class, 'markdelete']);
Route::get('mark/restore', [CategoryController::class, 'markrestore']);


// ProfileController
Route::get('profile', [ProfileController::class, 'profile']);
Route::post('edit/profile/post', [ProfileController::class, 'editprofilepost']);
Route::post('edit/password/post', [ProfileController::class, 'editpasswordpost']);
Route::post('change/profile/photo', [ProfileController::class, 'changeprofilephoto']);


// ProductController
Route::resource('product', ProductController::class);


// OrderController
Route::resource('order', OrderController::class);
Route::get('order/cancel/{order_id}', [OrderController::class, 'cancel'])->name('order.cancel');


// CartController
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/{coupon_name}', [CartController::class, 'index'])->name('cart.coupon');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');

// HomeController
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('send/newsletter', [App\Http\Controllers\HomeController::class, 'sendnewsletter'])->name('sendnewsletter');
Route::get('contact/upload/download/{contact_id}', [App\Http\Controllers\HomeController::class, 'contactuploaddownload'])->name('contactuploaddownload');

// CouponController
Route::resource('coupon', CouponController::class);

// CustomerController
Route::get('customer/home', [CustomerController::class, 'home'])->name('customerhome');
Route::get('customer/invoice/download/{order_id}', [CustomerController::class, 'customerinvoicedownload'])->name('customer.invoice.download');


// CheckoutController
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout/post', [CheckoutController::class, 'checkoutpost'])->name('checkout.post');
Route::post('get/city/list/ajax', [CheckoutController::class, 'getcitylistajax'])->name('get.city.list.ajax');
// Test
Route::get('test/mail', [CheckoutController::class, 'testmail'])->name('test.mail');


// GithubController
Route::get('login/github', [GithubController::class, 'redirectToProvider'])->name('redirect');
Route::get('login/github/callback', [GithubController::class, 'handleProviderCallback'])->name('user');


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});