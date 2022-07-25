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

Route::get('/','GuestController@home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard','AdminController@dashboard');  // ->middleware('auth','admin')
Route::get('/client/dashboard','ClientController@dashboard');
Route::get('/admin/categories','CategoryController@index')->middleware('auth','admin');
Route::post('/admin/category/store','CategoryController@store')->middleware('auth','admin');
Route::get('/admin/categorie/{id}/delete','CategoryController@destroy')->middleware('auth','admin');
Route::post('/admin/category/update','CategoryController@update')->middleware('auth','admin');
/*Route product */
Route::get('/admin/products','ProductController@index')->middleware('auth','admin');
Route::post('/admin/product/store','ProductController@store')->middleware('auth','admin');
Route::get('/admin/product/{id}/delete','ProductController@destroy')->middleware('auth','admin');
Route::post('/admin/product/update','ProductController@update')->middleware('auth','admin');


