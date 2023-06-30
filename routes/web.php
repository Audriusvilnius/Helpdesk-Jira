<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\StatusController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('status', StatusController::class);
});


// Route::prefix('admin/category')->name('category-')->group(function () {
//     Route::get('/', [Category::class, 'index'])->name('index')->middleware('roles:A|M');
//     Route::get('/create', [Category::class, 'create'])->name('create')->middleware('roles:A|M');
//     Route::post('/create', [Category::class, 'store'])->name('store')->middleware('roles:A|M');
//     Route::get('/show/{category}', [Category::class, 'show'])->name('show')->middleware('roles:A|M');
//     Route::get('/edit/{category}', [Category::class, 'edit'])->name('edit')->middleware('roles:A|M');
//     Route::put('/edit/{category}', [Category::class, 'update'])->name('update')->middleware('roles:A|M');
//     Route::delete('/delete/{category}', [Category::class, 'destroy'])->name('delete')->middleware('roles:A|M');
// });