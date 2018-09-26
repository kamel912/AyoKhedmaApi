<?php

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

use App\BusinessHours;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('streets/data', 'ObjectsController@streets');

//Route::group(['prefix' => 'streets', 'middleware' => 'auth'], function (){
//   Route::get('/', 'StreetController@index');
//   Route::get('/{street}', 'StreetController@show');
//   Route::get('/create', 'StreetController@create');
//});
Route::group(['middleware' => 'auth'],function (){
    Route::resources([
        'streets' => 'StreetsController',
        'regions' => 'RegionsController',
        'categories' => 'CategoriesController',
        'objects' => 'ObjectsController',
        'test' => 'TestController',
    ]);
});





