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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/cars');
    } else {
        return view('welcome');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get("/car/{id}/stats", "CostController@stats");
    Route::get("/car/{id}/costs", "CostController@index");
    Route::get("/cars/{id}/edit/photo", "CarController@editPhoto");
    Route::post("/cars/{id}/edit/photo", "CarController@updatePhoto");
    Route::post("/cars/{id}/delete/photo", "CarController@deletePhoto");

    Route::resource('cars', 'CarController');
});
