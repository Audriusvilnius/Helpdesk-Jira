<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UploadController as Upload;
use App\Http\Controllers\ContactController as Contact;
use App\Http\Controllers\ShareController as Share;
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
    Route::resource('important', ImportantController::class);
    Route::resource('upload', Upload::class);
    Route::resource('share', Share::class);
    Route::resource('contact', Contact::class);
});

Route::post('/message', [TicketController::class, 'message'])->name('ticket-message');
Route::get('/open', [TicketController::class, 'open'])->name('open-tickets');
Route::get('/close', [TicketController::class, 'close'])->name('close-tickets');
Route::get('/suspendet', [TicketController::class, 'suspendet'])->name('suspendet-tickets');

Route::post('/ticket/share', [Share::class, 'share'])->name('ticket-share');
Route::get('/share/remove/{id}', [Share::class, 'destroy'])->name('share-remove');

Route::prefix('file')->name('file-')->group(function () {
    Route::post('/upload', [Upload::class, 'uploads'])->name('uploads');
    Route::get('/downloads/{dir?}/{file?}', [Upload::class, 'download'])->name('downloads');
    Route::put('/remove/{file}', [Upload::class, 'remove'])->name('remove');
    Route::get('/delete/{id}', [Upload::class, 'destroy'])->name('delete');
});

Route::get('contact-us', [Contact::class, 'index']);
Route::post('contact-us', [Contact::class, 'store'])->name('contact.us.store');
