<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('guest.home');
// })->name('home');

Auth::routes();

Route::middleware('auth')
    ->namespace('User')
    ->name('user.')
    ->prefix('user')
    ->group(function() {
        Route::get('/', 'UserController@index')->name('dashboard');
        Route::get('/messages', 'MessagesController@index')->name('messages');
        Route::resource('dwellings', 'DwellingsController');
        Route::get('/sponsorisation', 'SponsorisationController@index')->name('sponsorisations');
        Route::get('/statistics', 'StatisticsController@index')->name('statistics');
        Route::post('/sponsorisation-form', 'SponsorisationController@update')->name('sponsorisations-form');
    });

Route::get('{any?}', function(){
    return view('guest.home');
})->where('any', '.*')->name('home');
