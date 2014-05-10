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

Route::get('/', function()
{
	$r = Registrant::take(40);
	return View::make('hello');
});


Route::resource('city', 'CityController');
Route::resource('city-competition-groups', 'CityCompetitionGroupController');
Route::resource('events', 'EventController');
Route::resource('commutes', 'CommuteController');
Route::resource('registrants', 'RegistrantController');
Route::resource('transport-modes', 'TransportModeController');
Route::resource('workplaces', 'WorkplaceController');
Route::resource('workplace-groups', 'WorkplaceGroupController');