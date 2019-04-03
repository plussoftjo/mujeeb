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




// supplier Login Controller 
Route::get('auth/fetchdata','SUPPLIERAPI\authController@fetchdata');
Route::get('auth/changeCountry/{id}','SUPPLIERAPI\authController@changeCountry');
Route::get('auth/changeCity/{id}','SUPPLIERAPI\authController@changeCity');
Route::post('auth/changeCatg','SUPPLIERAPI\authController@changeCatg');

Route::post('auth/store','SUPPLIERAPI\authController@store');

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

	Route::get('/order/price_list/{id}','API\myOrderController@price_list');

	Route::get('/order/accept_price/{id}','API\myOrderController@accept_price');

	Route::get('/order/messages/{id}','API\myOrderController@getMessages');

	//sent Message 
	Route::post('/message/send','API\myOrderController@sendMessage');

	//end order
	Route::get('/order/end/{id}','API\myOrderController@endOrder');

	//////////////////////// SUPPLIER API ////////////////
	///
	//////////////////////////////////////////////

	// order
	Route::get('supplier/order/fetch','SUPPLIERAPI\orderController@fetch_order');
	// get the order
	Route::get('supplier/order/id/{id}','SUPPLIERAPI\orderController@order');
	//submit price
	Route::post('supplier/order/submit_price','SUPPLIERAPI\orderController@submit_price');
	// taken order
	Route::get('supplier/takenorders','SUPPLIERAPI\orderController@takenorders');

	Route::get('supplier/last_order','SUPPLIERAPI\orderController@last_order');

	// FETCH USER 
	Route::get('supplier/user/auth','SUPPLIERAPI\authController@fetch');


	// check user if approve or not 
	Route::get('supplier/auth/check','SUPPLIERAPI\authController@check');




	///////// TEAM CONTROLELR ////////
	Route::get('supplier/team/fetchSubcatg','SUPPLIERAPI\teamController@fetchSubcatg');
	//store team
	Route::post('supplier/team/store','SUPPLIERAPI\teamController@store');
	//index Team
	Route::get('supplier/team/index','SUPPLIERAPI\teamController@index');
	// Get supplier
	Route::get('supplier/team/person/{id}','SUPPLIERAPI\teamController@person');
	// SEND PAYMENYT
	Route::post('supplier/payment/store','SUPPLIERAPI\paymentController@store');
	Route::get('supplier/payment/index','SUPPLIERAPI\paymentController@index');


	// update Info 
	Route::post('supplier/user/update','SUPPLIERAPI\authController@update');


	//msg 
	Route::get('supplier/welcomemsg/check','SUPPLIERAPI\welcomeMsgController@check');
	Route::post('supplier/welcomemsg/store','SUPPLIERAPI\welcomeMsgController@store');
	Route::post('supplier/welcomemsg/update','SUPPLIERAPI\welcomeMsgController@update');



	// report
	Route::get('supplier/report/today','SUPPLIERAPI\reportController@today');
	Route::get('supplier/report/week','SUPPLIERAPI\reportController@week');
	Route::get('supplier/report/month','SUPPLIERAPI\reportController@month');

});

Route::middleware('auth:api')->post('/broadcast/auth', 'API\BroadcastAuthController@auth');

Broadcast::channel('messages.*', function ($user) {
  return Auth::check();
});

