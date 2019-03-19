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
    return view('welcome');
});


// ADMIN PANEL 
Route::get('/admin-panel',function() {
	return view('admin');
});


// markeing 
Route::get('/marketing', function() {
	if(Auth::check())
	{
		return view('marketing');
	}else {
		return view('mlogin');
	}
})->name('marketing');


// mlogin 
Route::post('/mlogin','loginController@mlogin');




////////////////////////////////////////////////////////////////
//{{{{{{{{{{{{{{{{{ ADMIN PANEL SECTION }}}}}}}}}}}}}}}}}
/////////////////////////////////////////////////////////////

// Catgoray 
Route::get('/catg/index','ADMIN\catgController@index');
Route::post('/catg/store','ADMIN\catgController@store');
Route::get('/catg/destroy/{id}','ADMIN\catgController@destroy');
Route::post('/catg/update/image/{id}','ADMIN\catgController@updateImage');
Route::post('/catg/update/title/{id}','ADMIN\catgController@update');

// sub Catg
Route::get('/subCatg/index','ADMIN\subCatgController@index');
Route::post('/subCatg/store','ADMIN\subCatgController@store');
Route::get('/subCatg/destroy/{id}','ADMIN\subCatgController@destroy');
Route::post('/subCatg/update/image/{id}','ADMIN\subCatgController@updateImage');
Route::post('/subCatg/update/title/{id}','ADMIN\subCatgController@update');

// user reg Marketing user 
Route::post('/admin/user/marketing/store','ADMIN\userController@store');
Route::get('/admin/user/marketing/index','ADMIN\userController@index');
Route::post('/admin/user/marketing/update/{id}','ADMIN\userController@update');
Route::get('/admin/user/marketing/destroy/{id}','ADMIN\userController@destroy');

// country 
Route::get('/country/index','ADMIN\countryController@index');
Route::post('/country/store','ADMIN\countryController@store');
Route::get('/country/destroy/{id}','ADMIN\countryController@destroy');
Route::post('/country/update/image/{id}','ADMIN\countryController@updateImage');
Route::post('/country/update/title/{id}','ADMIN\countryController@update');

//city
Route::get('/city/index','ADMIN\cityController@index');
Route::post('/city/store','ADMIN\cityController@store');
Route::post('/city/update/{id}','ADMIN\cityController@update');
Route::get('/city/destroy/{id}','ADMIN\cityController@destroy');

//subcity
Route::get('/subcity/index','ADMIN\subcityController@index');
Route::post('/subcity/store','ADMIN\subcityController@store');
Route::post('/subcity/update/{id}','ADMIN\subcityController@update');
Route::get('/subcity/destroy/{id}','ADMIN\subcityController@destroy');





///////////////////////////// 
/////// Marketing
///////////////////////////// 

// maiun Controller 
Route::get('marketing/main/index','MARKETING\mainController@index');
Route::post('marketing/supplier/store','MARKETING\newEntryController@store');
Route::get('marketing/newEntry/index','MARKETING\newEntryController@indexf');

// New Entry Changes 
Route::get('marketing/newEntry/changeCountry/{id}','MARKETING\newEntryController@changeCountry');
Route::get('marketing/newEntry/changeCity/{id}','MARKETING\newEntryController@changeCity');
Route::get('marketing/newEntry/changeCatg/{id}','MARKETING\newEntryController@changeCatg');