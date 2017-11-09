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

Route::get('/', 'PagesController@home');

Route::get('careers', 'PostingsController@index');
Route::get('careers/{posting}/{slug?}', 'PostingsController@show');

Route::get('postings/{posting}/application', 'ApplicationsController@create');
Route::post('postings/{posting}/applications', 'ApplicationsController@store');

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post('applications/uploads/avatars', 'AvatarsController@store');
Route::post('applications/uploads/cover-letters', 'CoverLettersController@store');
Route::post('applications/uploads/cvs', 'CVsController@store');

Route::get('contact', 'ContactMessageController@create');
Route::post('contact', 'ContactMessageController@store');

Route::get('thank-you', 'PagesController@thanks');



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'DashboardController@show');

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

        Route::post('postings/{posting}/application-fields', 'PostingApplicationFieldsController@update');

        Route::post('published-postings', 'PublishedPostingsController@store');
        Route::delete('published-postings/{posting}', 'PublishedPostingsController@delete');

        Route::get('postings-order', function() {
            $postings = \App\Careers\Posting::all()->map(function($posting) {
               return [
                   'id' => $posting->id,
                   'name' => $posting->title,
                   'position' => $posting->position ?? 999
               ];
            });
            return view('admin.postings.order.show', ['postings' => $postings]);
        });
        Route::post('postings-order', 'PostingsOrderController@store');

        Route::get('applications', 'ApplicationsController@index');
        Route::get('applications/{application}', 'ApplicationsController@show');
        
        Route::get('inquiries', 'InquiriesController@index');
        Route::delete('inquiries/{message}', 'InquiriesController@delete');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'services', 'namespace' => 'Services'], function() {
       Route::get('users', 'UsersController@index');
    });
});

