<?php

use App\Http\Controllers\BuilderController;
use App\Http\Controllers\FormController;
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
Route::get('builder', [BuilderController::class, 'create'])->name('builder');
Route::get('form', [FormController::class, 'create'])->name('form');
Route::get('show', [FormController::class, 'show'])->name('show');


Route::prefix('form-builder')->name('form-builder.')->group(function () {
    Route::post('store', [BuilderController::class, 'store'])->name('store');
});

Route::prefix('form')->name('form.')->group(function () {
    Route::post('store', [FormController::class, 'store'])->name('store');
});

Route::prefix('dynamic-forms')->name('dynamic-forms.')->group(function () {
    // Dummy route so we can use the route() helper to give formiojs the base path for this group
    Route::get('/')->name('index');

    Route::post('storage/s3', [Controllers\DynamicFormsStorageController::class, 'storeS3'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::get('storage/s3', [Controllers\DynamicFormsStorageController::class, 'showS3'])->name('S3-file-download');
    Route::get('storage/s3/{fileKey}', [Controllers\DynamicFormsStorageController::class, 'showS3'])->name('S3-file-redirect');

    Route::post('storage/url', [Controllers\DynamicFormsStorageController::class, 'storeURL'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::get('storage/url', [Controllers\DynamicFormsStorageController::class, 'showURL'])->name('url-file-download');
    Route::delete('storage/url', [Controllers\DynamicFormsStorageController::class, 'deleteURL']);

    Route::get('form', [Controllers\ResourceController::class, 'index']);
    Route::get('form/{resource}', [Controllers\ResourceController::class, 'resource']);
    Route::get('form/{resource}/submission', [Controllers\ResourceController::class, 'resourceSubmissions']);
});
