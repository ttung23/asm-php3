<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use Google\Service\Analytics\Profile;
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

Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/detail/{id}', [GuestController::class, 'detail'])->name('detail');

Route::get('/login', [UserController::class, 'login'])->name('users.login');
Route::post('/authen', [UserController::class, 'authen'])->name('users.authen');

Route::get('/cart', [GuestController::class, 'cart'])->name('cart');
Route::middleware('checkCart')->post('/addCart', [GuestController::class, 'addCart'])->name('addCart');

Route::middleware('auth')->get('/admin/', [ProductController::class, 'index'])
    ->name('admin');

// BANNER
Route::middleware('auth')->group(function () {
    Route::get('/admin/banners/', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::get('/admin/banners/create/', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/admin/banners/', [BannerController::class, 'store'])->name('admin.banners.store');
    Route::get('/admin/banners/edit/{id}', [BannerController::class, 'edit'])->name('admin.banners.edit');
    Route::post('/admin/banners/update/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('/admin/banners/delete/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');
});

// ADMIN
Route::middleware('auth', 'role')->group(function () {
    Route::get('/admin/profile/', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/admin/profile/create/', [ProfileController::class, 'create'])->name('admin.profile.create');
    Route::post('/admin/profile/', [ProfileController::class, 'store'])->name('admin.profile.store');
//    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

// USER
Route::middleware('auth')->group(function () {
    Route::get('/admin/users/', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create/', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// PRODUCT
Route::middleware('auth')->group(function () {
    Route::get('/admin/products/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create/', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// CATEGORY
Route::middleware('auth')->group(function () {
    Route::get('/admin/categories/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create/', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});

// COLOR
Route::middleware('auth')->group(function () {
    Route::get('/admin/colors/', [ColorController::class, 'index'])->name('admin.colors.index');
    Route::get('/admin/colors/create/', [ColorController::class, 'create'])->name('admin.colors.create');
    Route::post('/admin/colors/', [ColorController::class, 'store'])->name('admin.colors.store');
    Route::get('/admin/colors/edit/{id}', [ColorController::class, 'edit'])->name('admin.colors.edit');
    Route::post('/admin/colors/update/{id}', [ColorController::class, 'update'])->name('admin.colors.update');
    Route::delete('/admin/colors/delete/{id}', [ColorController::class, 'destroy'])->name('admin.colors.destroy');
});

// MATERIAL
Route::middleware('auth')->group(function () {
    Route::get('/admin/materials/', [MaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/admin/materials/create/', [MaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('/admin/materials/', [MaterialController::class, 'store'])->name('admin.materials.store');
    Route::get('/admin/materials/edit/{id}', [MaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::post('/admin/materials/update/{id}', [MaterialController::class, 'update'])->name('admin.materials.update');
    Route::delete('/admin/materials/delete/{id}', [MaterialController::class, 'destroy'])->name('admin.materials.destroy');
});

// SIZE
Route::middleware('auth')->group(function () {
    Route::get('/admin/sizes/', [SizeController::class, 'index'])->name('admin.sizes.index');
    Route::get('/admin/sizes/create/', [SizeController::class, 'create'])->name('admin.sizes.create');
    Route::post('/admin/sizes/', [SizeController::class, 'store'])->name('admin.sizes.store');
    Route::get('/admin/sizes/edit/{id}', [SizeController::class, 'edit'])->name('admin.sizes.edit');
    Route::post('/admin/sizes/update/{id}', [SizeController::class, 'update'])->name('admin.sizes.update');
    Route::delete('/admin/sizes/delete/{id}', [SizeController::class, 'destroy'])->name('admin.sizes.destroy');
});

// PROMOTION
Route::middleware('auth')->group(function () {
    Route::get('/admin/promotions/', [PromotionController::class, 'index'])->name('admin.promotions.index');
    Route::get('/admin/promotions/create/', [PromotionController::class, 'create'])->name('admin.promotions.create');
    Route::post('/admin/promotions/', [PromotionController::class, 'store'])->name('admin.promotions.store');
    Route::get('/admin/promotions/edit/{id}', [PromotionController::class, 'edit'])->name('admin.promotions.edit');
    Route::post('/admin/promotions/update/{id}', [PromotionController::class, 'update'])->name('admin.promotions.update');
    Route::delete('/admin/promotions/delete/{id}', [PromotionController::class, 'destroy'])->name('admin.promotions.destroy');
});

// BANNER
Route::middleware('auth')->group(function () {
    Route::get('/admin/banners/', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::get('/admin/banners/create/', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/admin/banners/', [BannerController::class, 'store'])->name('admin.banners.store');
    Route::get('/admin/banners/edit/{id}', [BannerController::class, 'edit'])->name('admin.banners.edit');
    Route::post('/admin/banners/update/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('/admin/banners/delete/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');
});

// ROLE
Route::middleware('auth')->group(function () {
    Route::get('/admin/roles/', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/create/', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles/', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::post('/admin/roles/update/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/roles/delete/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});

require __DIR__.'/auth.php';
