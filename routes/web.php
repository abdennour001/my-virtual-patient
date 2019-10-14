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

// create interactive case routes
Route::get('/create-interactive-case-1', function () {
    return view('interactive-case/create-interactive-case-1');
});

Route::get('/create-interactive-case-2', function () {
    return view('interactive-case/create-interactive-case-2');
});

Route::get('/create-interactive-case-3', function () {
    return view('interactive-case/create-interactive-case-3');
});

// delete interactive case routes
Route::get('/delete-interactive-case', function () {
    return view('interactive-case/delete-interactive-case');
});

// edit interactive case
Route::get('/edit-interactive-case-1', function () {
    return view('interactive-case/edit-interactive-case-1');
});

Route::get('/edit-interactive-case-2', function () {
    return view('interactive-case/edit-interactive-case-2');
});

Route::get('/edit-interactive-case-3', function () {
    return view('interactive-case/edit-interactive-case-3');
});

// interactive case
Route::get('/interactive-case', function () {
    return view('interactive-case/interactive-case');
});

// my interactive cases
Route::get('/my-interactive-cases', function () {
    return view('interactive-case/my-interactive-cases');
});

// session route
Route::get('/session', function () {
    return view('session/session');
});

Route::get('/live-sessions', function () {
    return view('session/live-sessions');
});

Route::get('/start-session', function () {
    return view('session/start-session');
});
