<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//require __DIR__.'/auth.php';
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('posts.home');
Route::get('/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
//Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//Route::resource('posts', PostController::class);
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add the following route to the existing routes because we want the posts route accessible to authenticated users only.
    // We'll use a resource route because it contains all the exact routes we need for a typical CRUD application.
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('comments', CommentController::class);
});

