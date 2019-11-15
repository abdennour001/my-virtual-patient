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
    return view('home');
});
Route::get('about', 'AboutController@index');

// admin

Route::get('admin/password/reset', function () {
    return view('admin.passwords.email');
});
Route::get('admin/login', 'AdminController@loginView');
Route::post('admin/admin_login', 'AdminController@admin_login');
Route::get('admin', 'AdminController@index');
Route::post('admin/logout', 'AdminController@logout');
Route::get('admin/edit_view/{id}', 'AdminController@editView');
Route::post('admin/edit', 'AdminController@edit');
Route::get('admin/edit_password_view/{id}', 'AdminController@editPasswordView');
Route::post('admin/edit_password', 'AdminController@editPassword');


// admin/approvel |disapprovel

Route::get('admin/approvel/{id}', 'AdminController@approvel');
Route::get('admin/disapprovel/{id}', 'AdminController@disapprovel');


// admin/enable | disable

Route::get('admin/enable/{id}', 'AdminController@enable');
Route::get('admin/disable/{id}', 'AdminController@disable');

// admin/search_pedding

Route::post('admin/search_pedding', 'AdminController@search_pedding');
Route::post('admin/search_approved', 'AdminController@search_approved');

/*****************************************************************************************/

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

Route::get('/session/{sessionID}', 'SessionController@show');


Route::get('/live-sessions', 'SessionController@indexLiveSessions');

Route::get('/start-session', 'SessionController@indexStartSession');

// create a new session
Route::post('/start-session/add', 'SessionController@store');

// create a section
Route::get('/create-section', 'SectionController@create');
Route::post('/create-section/add', 'SectionController@store');


// create virtual patient RESTful API

// store an interactive case
Route::post('/create-interactive-case/add', 'InteractiveCaseController@store');
Route::get('/interactive-case/{interactiveCaseID}', 'InteractiveCaseController@show');
