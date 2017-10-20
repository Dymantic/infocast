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
    $postings = \App\Careers\Posting::latest()->take(4)->get();
    return view('front.home.page', ['postings' => $postings]);
});

Route::get('careers', function () {
    $postings = \App\Careers\Posting::where('published', true)->latest()->get();
    return view('front.careers.page', ['postings' => $postings]);
});

Route::get('careers/{posting}', function (\App\Careers\Posting $posting) {
    return view('front.job-posts.page', ['posting' => $posting]);
});

Route::get('postings/{posting}/application', function (\App\Careers\Posting $posting) {
    return view('front.job-posts.application', ['posting' => $posting]);
});

Route::post('postings/{posting}/applications', 'ApplicationsController@store');

$this->get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('admin/login', 'Auth\LoginController@login');
$this->post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post('applications/uploads/avatars', 'AvatarsController@store');
Route::post('applications/uploads/cover-letters', 'CoverLettersController@store');
Route::post('applications/uploads/cvs', 'CVsController@store');

Route::get('contact', 'ContactMessageController@create');
Route::post('contact', 'ContactMessageController@store');

Route::get('thank-you', function() {
    return view('front.thanks', ['name' => request('name')]);
});



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', function() {
            return view('welcome');
        });

        Route::get('users', 'UsersController@index');
        Route::post('users', 'UsersController@store');
        Route::post('users/{user}', 'UsersController@update');
        Route::delete('users/{user}', 'UsersController@delete');

        Route::post('super-admins', 'SuperAdminsController@store');
        Route::delete('super-admins/{user}', 'SuperAdminsController@delete');

        Route::post('me/password', 'UserPasswordController@update');

        Route::get('postings', 'PostingsController@index');
        Route::get('postings/create', 'PostingsController@create');
        Route::get('postings/{posting}', 'PostingsController@show');
        Route::get('postings/{posting}/edit', 'PostingsController@edit');
        Route::post('postings', 'PostingsController@store');
        Route::post('postings/{posting}', 'PostingsController@update');
        Route::delete('postings/{posting}', 'PostingsController@delete');

        Route::post('published-postings', 'PublishedPostingsController@store');
        Route::delete('published-postings/{posting}', 'PublishedPostingsController@delete');

        Route::get('applications', 'ApplicationsController@index');
        Route::get('applications/{application}', 'ApplicationsController@show');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'services', 'namespace' => 'Services'], function() {
       Route::get('users', 'UsersController@index');
    });
});

