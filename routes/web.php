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

Route::post('/prematch_photo_output', ['as' => 'prematch_photo_output', 'uses' => 'PreMatchController@photo_output']);
Route::post('/result_photo_output', ['as' => 'result_photo_output', 'uses' => 'ResultController@photo_output']);

Route::group( ['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('test', ['uses' => 'PreMatchController@photo_input', 'as' => 'test']);
  });
