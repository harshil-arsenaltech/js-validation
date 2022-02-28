<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserDocumentController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::resource('blog', BlogController::class);
Route::resource('setting', SettingController::class);
Route::resource('faq', FaqController::class);
Route::resource('document', UserDocumentController::class);
Route::get('findNearestLocationInKM', [BlogController::class, 'findNearestLocationInKM']);
Route::get('findLocationWithNew', [BlogController::class, 'findLocationWithNew']);
Route::get('getIdelTrips', [BlogController::class, 'getIdelTrips']);

Route::resource('post', PostController::class);

Route::get('/test', function(){
    return view('new-body');
});



// Route::get('/test/second/page', function(){
//     return view('new-page-body');
// });

Route::get('/test/second/page', [PostController::class,'index']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
