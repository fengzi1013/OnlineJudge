<?php

use App\Http\Controllers\Api\SolutionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
reponse return {
    'ok':1,
    'msg':'',
    'data':{}
}
*/

Route::namespace('Api')->name('api.')->group(function () {
    // =========================== Solution =================================
    Route::name('solution.')->where(['id' => '[0-9]+'])->group(function () {
        Route::middleware(['auth:api', 'CheckBlacklist'])->prefix('/solution')->group(function () {
            Route::post('/submit', 'SolutionController@submit')->name('submit');
            Route::post('/submit_local_test', 'SolutionController@submit_local_test')->name('submit_local_test');
            Route::get('/result', 'SolutionController@result')->name('result');
            // Route::get('/solution/result_by_tokens', 'SolutionController@result_by_tokens')->name('result_by_tokens');
        });
    });

    // CK editor upload image
    Route::post('/ck_upload_image', 'UploadController@ck_upload_image')->name('ck_upload_image');

});
