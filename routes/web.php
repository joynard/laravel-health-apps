<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnresourceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ArticleController;
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

Route::resource('photos', PhotoController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
    Route::post('/ajax/service/getEditForm', [ServiceController::class, 'getEditForm'])->name('service.getEditForm');
    Route::post('/ajax/service/getEditFormB', [ServiceController::class, 'getEditFormB'])->name('service.getEditFormB');
    Route::post('/ajax/service/saveDataUpdate', [ServiceController::class, 'saveDataUpdate'])->name('service.saveDataUpdate');
    Route::post('/ajax/service/deleteData', [ServiceController::class, 'deleteData'])->name('service.deleteData');

    Route::resource('categories', CategoryController::class);
    Route::post('/ajax/category/getEditForm', [CategoryController::class, 'getEditForm'])->name('category.getEditForm');
    Route::post('/ajax/category/getEditFormB', [CategoryController::class, 'getEditFormB'])->name('category.getEditFormB');
    Route::post('/ajax/category/saveDataUpdate', [CategoryController::class, 'saveDataUpdate'])->name('category.saveDataUpdate');
    Route::post('/ajax/category/deleteData', [CategoryController::class, 'deleteData'])->name('category.deleteData');

    Route::get('/category', function() {
        return redirect()->route('categories.index');
    });
});

Route::resource('unresources', UnresourceController::class);

Route::resource('transactions', TransactionController::class);
Route::post('/ajax/transaction/getEditForm', [TransactionController::class, 'getEditForm'])->name('transaction.getEditForm');
Route::post('/ajax/transaction/getEditFormB', [TransactionController::class, 'getEditFormB'])->name('transaction.getEditFormB');
Route::post('/ajax/transaction/saveDataUpdate', [TransactionController::class, 'saveDataUpdate'])->name('transaction.saveDataUpdate');
Route::post('/ajax/transaction/deleteData', [TransactionController::class, 'deleteData'])->name('transaction.deleteData');

Route::resource('doctors', DoctorController::class);
Route::post('/ajax/doctor/getEditForm', [DoctorController::class, 'getEditForm'])->name('doctor.getEditForm');
Route::post('/ajax/doctor/getEditFormB', [DoctorController::class, 'getEditFormB'])->name('doctor.getEditFormB');
Route::post('/ajax/doctor/saveDataUpdate', [DoctorController::class, 'saveDataUpdate'])->name('doctor.saveDataUpdate');
Route::post('/ajax/doctor/deleteData', [DoctorController::class, 'deleteData'])->name('doctor.deleteData');

Route::resource('articles', ArticleController::class);
Route::post('/ajax/article/getEditForm', [ArticleController::class, 'getEditForm'])->name('article.getEditForm');
Route::post('/ajax/article/getEditFormB', [ArticleController::class, 'getEditFormB'])->name('article.getEditFormB');
Route::post('/ajax/article/saveDataUpdate', [ArticleController::class, 'saveDataUpdate'])->name('article.saveDataUpdate');
Route::post('/ajax/article/deleteData', [ArticleController::class, 'deleteData'])->name('article.deleteData');

Route::get('/reports', function () {
    return view('reports.index');
})->name('reports.index');

Route::get('/', function () {
    return view('welcome');
});
    
Route::get('/welcome', function(){
    return "Selamat Datang di Portal Kesehatan";
});
        
Route::get('/menu', function(){
    return view('menu');
})->name('menu');

Route::get('/menu/{menu}', function($menu){
    if($menu=="konsultasi"){
        return view('konsultasi');
    }
    else if($menu=="janji"){
        return view('janji');
    }
    else{
        return "Halaman tidak ditemukan";
    }
})->name('menu.page');

Route::get('/admin/{admincat}', function($admincat){
    if($admincat=="categories"){
        return "Portal Manajemen: Daftar Kategori Layanan";
    }
    else if($admincat=="order"){
        return "Portal Manajemen: Daftar Konsultasi dan Janji Temu";
    }
    else if($admincat=="members"){
        return "Portal Manajemen: Daftar Pasien";
    }
    else{
        return "Halaman tidak ditemukan";
    }
})->name('admin.page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
