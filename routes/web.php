<?php

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
    });

Route::get('{any?}', function(){
    return view('guest.home');
})->where('any', '.*')->name('home');
