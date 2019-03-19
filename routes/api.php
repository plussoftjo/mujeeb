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

// <<<<<<<<<<<< USER CONTROLLER  >>>>>>>>>>>>>>> 
// Login 
Route::post('user/login','API\authController@login');
Route::post('user/reg','API\authController@reg');


// WITH AUTH 

Route::group(['middleware' => 'auth:api'], function(){ 

//mainController 

	//check profile
	Route::get('/main/checkProfile','API\mainController@checkProfile');
	// Change Country 
	Route::get('/main/getCountry','API\mainController@getCountry');
	Route::get('/main/changeCountry/{id}','API\mainController@changeCountry');
	Route::get('/main/changeCity/{id}','API\mainController@changeCity');
	Route::post('/main/saveProfile','API\mainController@saveProfile');

	// Service
	Route::get('/main/services/index','API\mainController@services');

	// GET SUPPLIER WITH THE ID 
	Route::get('/main/service/get/{id}','API\mainController@fetchService');
	// GET SUB CATG
	Route::get('/service/getsub/{id}','API\mainController@getSubservice');
	// order 
	Route::post('/service/direct/order','API\orderController@store');
	Route::post('/service/price/order','API\orderController@order_price');


	// My Order 
	Route::get('/myorder/index','API\myOrderController@myOrder');
	Route::get('/myorder/now','API\myOrderController@now');



	// order Approve 
	// Whene To state tow
	Route::get('/order/approve/{id}','API\orderController@approve_order');
	//feedback
	Route::post('/order/feedback/store','API\orderController@feedback');
	//destroy order
	Route::get('/order/destroy/{id}','API\orderController@destroyOrder');


});