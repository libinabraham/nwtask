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
    return view('welcome');

});




Auth::routes();

Route::group(['prefix' => 'admin'], function(){

  Route::get('/', 'AdminController@login');
  Route::get('/login', 'AdminController@login')->name('admin.login');
  Route::get('/logout', 'AdminController@logout')->name('admin.logout');
  Route::post('/login_check', 'AdminController@login_check');
  Route::resource('bills','BillController')->middleware('is_admin');
  Route::delete('/bills/remove/{id}', 'BillController@remove_item')->name('bills.remove')->middleware('is_admin');
  Route::post('/bills/discount/{id}', 'BillController@add_discount')->name('bills.discount')->middleware('is_admin');
  Route::get('/bills/invoice/{id}', 'BillController@gen_invoice')->name('bills.invoice')->middleware('is_admin');


});



Route::get('/home', 'HomeController@index')->name('home');
