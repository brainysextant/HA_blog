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

Route::get('/',                              'PagesController@showHome');
Route::get('/nosotros',                      'PagesController@showAbout');
Route::get('/ventas',                        'SalesController@filterCars');
Route::post('/contacto',                     'PagesController@contact');

// ADMIN:

Route::group(['prefix'=>'/admin', 'middleware'=>'auth'], function() {
    
    Route::get('/', function() {
        return redirect('/admin/autos');
    });

    // Admin de Autos:
    Route::get('/autos',                              'AdminController@showCars');
    Route::get('/autos/crear',                        'AdminController@showCarCreate');
    Route::get('/autos/{id}/editar',                  'AdminController@showCarEdit');
    Route::post('/autos',                             'AdminController@createCar');
    Route::post('/autos/{car}/editar',                'AdminController@editCar');
    Route::get('/autos/{car}/eliminar',               'AdminController@deleteCar');

    // Admin de Marcas:
    Route::get('/marcas',                             'AdminController@showBrands');
    Route::get('/marcas/crear',                       'AdminController@showBrandCreate');
    Route::get('/marcas/{id}/editar',                 'AdminController@showBrandEdit');
    Route::post('/marcas',                            'AdminController@createBrand');
    Route::post('/marcas/{brand}/editar',             'AdminController@editBrand');
    Route::get('/marcas/{brand}/eliminar',            'AdminController@deleteBrand');

    // Admin de Modelos:
    Route::get('/modelos',                            'AdminController@showModels');
    Route::get('/modelos/crear',                      'AdminController@showModelCreate');
    Route::get('/modelos/{id}/editar',                'AdminController@showModelEdit');
    Route::post('/modelos',                           'AdminController@createCarModel');
    Route::post('/modelos/{car_model}/editar',        'AdminController@editCarModel');
    Route::get('/modelos/{car_model}/eliminar',       'AdminController@deleteCarModel');

    // Ruta para realizar logout del usuario loggueado:
    Route::get('/logout',                             'Auth\LoginController@logout');
    
});

Auth::routes();