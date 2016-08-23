<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', 'SessionsController@index');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController');


Route::group(array('before' => 'auth'), function()
{
	Route::resource('user', 'UserController');
	Route::resource('checkin', 'CheckinController');
	Route::resource('approval', 'ApprovalController');
	Route::resource('search', 'SearchController');
	Route::resource('status', 'StatusController');
	Route::resource('report', 'ReportController');

	//Route::get('admin', 'AdminController@index');
	//Route::get('user', 'UserController@index');
	//Route::get('download', 'DownloadController@index');
	//Route::get('news', 'NewsController@index');
	//Route::get('uuser', 'UuserController@index');
	//Route::get('udownload', 'UdownloadController@index');
	//Route::get('uprofile', 'UprofileController@index');
	//Route::get('ucontact', 'UcontactController@index');
});

/**
Route::get('/', function()
{
	User::create([
		'username' => 'dlapegera',
		'password' => Hash::make('cpi12345')
	]);
});
**/
