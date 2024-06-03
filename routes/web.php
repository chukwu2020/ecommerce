<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/signin', function () {
//     return view('signin');
// });

Route::get('/create', function () {
    return view('create');
});

Route::post('store', [UserController::class, 'store'])->name('store_user');  //route to create a new user, route name is what you put in the action on your form in the create view
Route::post('user_logout', [UserController::class, 'user_logout']) ->name('user_logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin']) -> group (function(){
    Route::get('admin/dashboard', [AdminController::class, 'admin_dashboard']) ->name('admin_dashboard');

    // /route for catrgory
    Route::get('admin/category', [AdminController::class, 'category'])->name('category');
 
    //add new category
    Route::post('add_category', [AdminController::class, 'add_category'])->name('add_category');
//delete category
Route::get('/deleteCategory/{id}',[AdminController::class, 'deleteCategory'])->name('deleteCategory');
    });

