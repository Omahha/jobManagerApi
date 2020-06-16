<?php

use App\Company;
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

Route::post('/register', 'API\RegisterController@register');

Route::post('/login', 'API\RegisterController@login');

Route::get('/request/error', 'API\RegisterController@requestError');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('/companies', 'CompaniesController');

    Route::get('/company/{company}', 'CompaniesController@test');

    Route::resource('/user', 'UsersController');

    Route::resource('/user/{user}/action', 'ActionsController');

    Route::resource('/admin/users', 'AdminUsersController')->middleware('admin');
    // Route::resource('/admin/users', 'AdminUsersController');
});
