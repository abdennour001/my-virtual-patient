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

// section
Route::get('section/edit_section/{id}', 'SectionController@editViewSection');
Route::post('section/edit_section_fun', 'SectionController@editSection');
Route::get('section/deleteSection/{id}', 'SectionController@deleteSection');

Route::post('section/search_section', 'SectionController@search_section');

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



// instractor

Route::get('instractor/password/reset', function () {
    return view('instractor.passwords.email');
});
Route::get('instractor/login', 'InstractorController@loginView');
Route::get('instractor/register', 'InstractorController@registerView');
Route::post('instractor/instractor_register', 'InstractorController@instractor_register');
Route::post('instractor/instractor_login', 'InstractorController@instractor_login');
Route::get('instractor', 'InstractorController@index');
Route::post('instractor/logout', 'InstractorController@logout');
Route::get('instractor/edit_view/{id}', 'InstractorController@editView');
Route::post('instractor/edit', 'InstractorController@edit');
Route::get('instractor/edit_password_view/{id}', 'InstractorController@editPasswordView');
Route::post('instractor/edit_password', 'InstractorController@editPassword');

Route::get('instractor/create_sections/{id}', 'InstractorController@create_sections');
Route::post('instractor/create_sections_fun', 'InstractorController@create_sections_fun');
Route::get('instractor/section/{id}', 'InstractorController@get_my_section');


// student

Route::get('student/password/reset', function () {
    return view('student.passwords.email');
});
Route::get('student/login', 'StudentController@loginView');
Route::get('student/register', 'StudentController@registerView');
Route::post('student/student_register', 'StudentController@student_register');
Route::post('student/student_login', 'StudentController@student_login');
Route::get('student', 'StudentController@index');
Route::post('student/logout', 'StudentController@logout');
Route::get('student/edit_view/{id}', 'StudentController@editView');
Route::post('student/edit', 'StudentController@edit');
Route::get('student/edit_password_view/{id}', 'StudentController@editPasswordView');
Route::post('student/edit_password', 'StudentController@editPassword');
Route::get('/student/live-sessions', 'StudentController@showLiveSessions');

Route::get('student/section', 'StudentController@get_my_section');


/*****************************************************************************************/

// interactive case
Route::get('/instractor/interactive-case/{id}', 'InteractiveCaseController@index');

// my interactive cases
Route::get('/my-interactive-cases', 'InteractiveCaseController@indexAll');

// create interactive case routes
Route::get('/create-interactive-case-1', 'InteractiveCaseController@indexCreateInteractiveCase1');
Route::get('/create-interactive-case-2', 'InteractiveCaseController@indexCreateInteractiveCase2');

// delete interactive case routes
Route::get('/delete-interactive-case/{id}', 'InteractiveCaseController@indexDeleteInteractiveCase');

// edit interactive case
Route::get('/edit-interactive-case-1', 'InteractiveCaseController@indexEditInteractiveCase1');
Route::get('/edit-interactive-case-2', 'InteractiveCaseController@indexEditInteractiveCase2');

// session route
Route::get('/session', 'SessionController@index');

Route::get('/session/{sessionID}', 'SessionController@show');


Route::get('/live-sessions', 'SessionController@indexLiveSessions');

Route::get('/start-session', 'SessionController@indexStartSession');
Route::get('/delete-session/{id}', 'SessionController@delete');

// create a new session
Route::post('/start-session/add', 'SessionController@store');

// create a section
Route::get('/create-section', 'SectionController@create');
Route::post('/create-section/add', 'SectionController@store');


// create virtual patient RESTful API

// store an interactive case
Route::post('/create-interactive-case/add', 'InteractiveCaseController@store');
Route::get('/interactive-case/{interactiveCaseID}', 'InteractiveCaseController@show');
