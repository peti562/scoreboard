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

Route::get(
  '/',
  function () {
    return view('welcome');
  }
);

/*Route::get('/', function () {
  return redirect('admin');
});*/

Route::get('/render', ['as' => 'render', 'uses' => 'RenderController@execute']);
Route::get('/prematch', ['as' => 'prematch', 'uses' => 'PreMatchController@photo_input']);

Route::get('/result_photo_output', ['as' => 'result_photo_output', 'uses' => 'GeneratorController@result']);
Route::get('/lineups', ['as' => 'lineups', 'uses' => 'GeneratorController@lineups']);
Route::get('/getimage', ['as' => 'getimage', 'uses' => 'GeneratorController@getimage']);
Route::get('/getcountries', ['as' => 'getcountries', 'uses' => 'CountriesController@get']);


Route::post('/prematch_photo_output', ['as' => 'prematch_photo_output', 'uses' => 'PreMatchController@photo_output']);
Route::post('/result_photo_output', ['as' => 'result_photo_output', 'uses' => 'GeneratorController@result']);


Route::group( ['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('test', ['uses' => 'PreMatchController@photo_input', 'as' => 'test']);
  });
