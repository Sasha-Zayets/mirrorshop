<?php

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

Route::get('test', 'Controller@getData');
Route::get('list', 'Controller@userData');

Route::post('submit-form', 'Api\FormController@submit');

Route::get('sliders', 'Api\SliderController@index');
Route::get('settings', 'Api\SettingsController@index');

Route::group(['prefix'=>'admin','middleware' => 'auth:api'], function() {
    Route::get('user', 'Api\TestController@user');

    Route::resource('settings', 'Api\Admin\SettingController');
    Route::resource('sliders', 'Api\Admin\SliderController');
    Route::post('sliders/sort', 'Api\Admin\SliderController@sort');

    Route::post('load-image/', 'Api\Admin\AdminController@loadImage');
});
