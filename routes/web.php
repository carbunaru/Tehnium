<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\front\PagesController;
use App\Http\Controllers\admin\ArticlesController;
use App\Http\Controllers\admin\PhotosController;
use App\Http\Controllers\admin\MessageController;

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

Route::get('/', function () {
    return view('front.home');
});

Route::get('/dashboard', function () {
    return view('admin.control_panel');
})->middleware(['auth'])->name('dashboard');

// Rute administrator

Route::prefix('admin')->middleware(['admin'])->group(function(){

    Route::get('/users', [UsersController::class, 'showUsers'])->name('users');
    Route::get('/user-new', [UsersController::class, 'newUser'])->name('user-new');
    Route::post('/user-new', [UsersController::class, 'addUser'])->name('user-add');
    Route::get('/user-edit/{id}', [UsersController::class, 'showEditUser'])->name('user-editForm');
    Route::put('/user-edit/{id}', [UsersController::class, 'updateUser'])->name('user-update');
    Route::delete('/user-delete/{id}', [UsersController::class, 'deleteUser'])->name('user-delete');
});

// Rute pentru categorii

    Route::prefix('admin')->middleware(['auth','verified'])->group(function(){
        Route::get('/categories', [CategoryController::class, 'showCategories'])->name('admin-categories');
        Route::get('/categories/new', [CategoryController::class, 'newCategoryForm'])->name('admin-newCategoryForm');
        Route::post('/categories/new', [CategoryController::class, 'addCategoryForm'])->name('admin-addCategoryForm');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'editCategoryForm'])->name('admin-editCategoryForm');
        Route::put('/categories/edit/{id}', [CategoryController::class, 'updateCategoryForm'])->name('admin-updateCategoryForm');
        Route::delete('/categories/delete/{id}', [CategoryController::class, 'deleteCategoryForm'])->name('admin-deleteCategoryForm');

// Rute articole

        Route::get('/pages', [ArticlesController::class, 'showArticles'])->name('admin.showArticles');
        Route::get('/pages/new', [ArticlesController::class, 'newArticles'])->name('admin.newArticles');
        Route::post('/pages/new', [ArticlesController::class, 'addArticles'])->name('admin.addArticles');
        Route::get('/pages/edit/{id}', [ArticlesController::class, 'editArticles'])->name('admin.editArticles');
        Route::put('/pages/edit/{id}', [ArticlesController::class, 'updateArticles'])->name('admin.updateArticles');
        Route::delete('/pages/delete/{id}', [ArticlesController::class, 'deleteArticles'])->name('admin.deleteArticles');

        Route::get('/pages/categories/{id}', [ArticlesController::class, 'showCategoriesArticles'])->name('admin.showCategoriesArticles');
        Route::put('/pages/categories/{id}', [ArticlesController::class, 'setCategoriesArticles'])->name('admin.setCategoriesArticles');

// Rute comentarii

        Route::get('/comments/{id}', [MessageController::class, 'showComments'])->name('admin.showComments');
        Route::delete('/comments/delete/{id}', [MessageController::class, 'deleteComment'])->name('admin.deleteComment');

// Rute galerie foto

        Route::get('page-photos/{id}', [PhotosController::class, 'showFormPhotos'])->name('admin.showFormPhotos');
        Route::post('page-photos/{id}', [PhotosController::class, 'uploadPhotos'])->name('admin.uploadPhotos');
        Route::put('page-photo/{id}', [PhotosController::class, 'updatePhoto'])->name('admin.updatePhoto');
        Route::delete('page-photos/{id}', [PhotosController::class, 'deleteAllPhotos'])->name('admin.deleteAllPhotos');
        Route::delete('page-photo/{id}', [PhotosController::class, 'deletePhoto'])->name('admin.deletePhoto');


        
        
    });

// Rute utilizator

Route::prefix('admin')->middleware(['auth','verified'])->group(function(){
    Route::get('/user-profile', [ProfileController::class, 'showProfile'])->name('user-profile');
    Route::put('/user-profile', [ProfileController::class, 'updateProfile'])->name('user-updateProfile');

    Route::put('/reset-password',[ProfileController::class, 'resetPassword'])->name('user-resetPassword');
     
});

// Rute publice

    Route::get('/', [PagesController::class, 'homePage'])->name('homePage');
    Route::get('/category/{category:slug}', [PagesController::class, 'categoryPage'])->name('category');
    Route::get('/articles/{article:slug}', [PagesController::class, 'articlePage'])->name('article');
    Route::get('/articles', [PagesController::class, 'showArticles'])->name('showNews');
    Route::post('/articles', [PagesController::class, 'showArticles'])->name('showArticles');
    Route::post('/articles/{id}/comment', [PagesController::class, 'addComment'])->name('addComment');
    Route::get('/contact', [PagesController::class, 'showContact'])->name('showContact');






require __DIR__.'/auth.php';
