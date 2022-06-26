<?php

use App\Http\Controllers\certifcateGenerator;
use App\Http\Controllers\opionController;
use App\Http\Controllers\UsersController;
use App\Models\opinionTopic;
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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login',[UsersController::class,'login']);
    Route::post('register', [UsersController::class, 'register']);
    Route::post('getUser', [UsersController::class, 'getUser']);
    Route::post('topicOpinion', [opionController::class, 'create']);
    Route::get('logout', [UsersController::class, 'logout']);

    Route::get('getTopic', [opionController::class, 'showTopic']);
    Route::get('getTopic/{id}', [opionController::class, 'detailTopic']);
    Route::get('getStudentOpinion/{id}', [opionController::class, 'getStudentOpinion']);
    Route::post('generateCertificate', [certifcateGenerator::class, 'process']);


});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('createOpinion', [opionController::class, 'createOpinion']);
    Route::get('/me', [UsersController::class, 'me']);
});