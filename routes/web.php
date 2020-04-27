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

Route::get('/', function () {
    return file_get_contents(public_path('_nuxt/index.html'));
})->where('path', '(.*)');

Route::get('/wmpanel/login/', ['uses' => 'Auth\Admin\LoginController@showLoginForm', 'as' => 'admin.login.form']);
Route::post('/wmpanel/login/', ['uses' => 'Auth\Admin\LoginController@login', 'as' => 'admin.login']);
Route::get('/wmpanel/logout/', ['uses' => 'Auth\Admin\LoginController@logout', 'as' => 'admin.logout']);

Route::view('/wmpanel/{path?}', 'index')->middleware(['web', 'auth:admin'])->where('path', '(.*)')->name('admin.index');

/* image */
Route::get('/images/{template}/{args}/', ['uses'=>'Image\ImageResizeController@getResponse', 'as'=>'imageResize'])
    ->where(['template' => '[0-9A-Za-z]+', 'args' => '[0-9A-Za-z.\/-]+']);


/*Route::get('/{path}', function () {
    return file_get_contents(public_path('_nuxt/index.html'));
})->where('path', '(.*)');*/
