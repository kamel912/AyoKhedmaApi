<?php

use App\Http\Resources\objects;
use App\BasicObject;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function () {
//    Route::get('/categories', 'CategoryController@index');
//    Route::get('/categories/main/{limit}', 'CategoryController@limited');
//    Route::get('/categories/{category}', 'CategoryController@show');
//
//    Route::get('/objects/{object}', 'ObjectsController@show');
//    Route::get('/objects/search=?{object}', 'ObjectsController@search');
//
//    Route::get('/objects', 'ObjectsController@index');


    Route::apiResources([
        'streets' => 'StreetController',
//        'regions' => 'RegionController',
        'categories' => 'CategoryController',
        'objects' => 'ObjectsController',
//        'test' => 'TestController',
    ]);
});

/*
Route::apiResource
//s
(
//    [
    '/categories'
//=>
,
'Api\CategoryController'
//,
//    '/objects' => 'Api\ObjectsController',
//    '/streets' => 'Api\StreetsController',
//]
);*/


Route::get('/obo', function () {
    return objects::collection(BasicObject::all());
});
Route::get('/ob', function () {
    $objects = BasicObject::select(['id'])->orderBy('rate', 'desc')->get();
    $objects->load(['phones', 'category:id,name,single_unit', 'region:id,name', 'street:id,name', 'comments' => function ($query) {
        $query->with('user:id,name')->where('status', '=', '1');
    }]);
    return $objects;
});


