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

// interactive case
Route::get('/interactive-case', 'InteractiveCaseController@index');

// my interactive cases
Route::get('/my-interactive-cases', 'InteractiveCaseController@indexAll');

// create interactive case routes
Route::get('/create-interactive-case-1', 'InteractiveCaseController@indexCreateInteractiveCase1');
Route::get('/create-interactive-case-2', 'InteractiveCaseController@indexCreateInteractiveCase2');

// delete interactive case routes
Route::get('/delete-interactive-case', 'InteractiveCaseController@indexDeleteInteractiveCase');

// edit interactive case
Route::get('/edit-interactive-case-1', 'InteractiveCaseController@indexEditInteractiveCase1');
Route::get('/edit-interactive-case-2', 'InteractiveCaseController@indexEditInteractiveCase2');

// session route
Route::get('/session', 'SessionController@index');

Route::get('/live-sessions', 'SessionController@indexLiveSessions');

Route::get('/start-session', 'SessionController@indexStartSession');

// create virtual patient RESTful API
Route::post('/create-interactive-case/add', 'InteractiveCaseController@store');

