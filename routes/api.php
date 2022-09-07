<?php

use Facade\FlareClient\Api;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')
    ->prefix('dwellings')
    ->group(function(){

        Route::get('/auth-user','UserAuthController@authUser');
        Route::get('/search-dwelling/{city}', 'SearchDwellingController@SearchDwelling');
        Route::get('/show-dwelling/{slug}', 'SearchDwellingController@showDwelling');
        Route::get('/search-filtered/{category}/{dwelling}', 'SearchDwellingController@searchByCategory');
    });

Route::post('save-message/', 'Api\StoreMessageController@store');
