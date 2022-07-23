<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard','AdminController@dashboard');
Route::get('/client/dashboard','ClientController@dashboard');
Route::get('/admin/categories','CategoryController@index');
Route::post('/admin/category/store','CategoryController@store');
Route::get('/admin/categorie/{id}/delete','CategoryController@destroy');


