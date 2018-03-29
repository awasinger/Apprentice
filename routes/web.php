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
})->middleware('guest');

Auth::routes(); // Add the app view back

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings', 'HomeController@edit')->name('settings');

Route::post('/settings', 'HomeController@update');

Route::get('/courses', 'CoursesController@index')->name('courses');

Route::get('/courses/search', 'CoursesController@search')->name('courseSearch');

Route::get('/courses/show', 'CoursesController@index');

Route::get('/courses/show/{id}', 'CoursesController@show');

Route::get('/courses/create', 'CoursesController@create');

Route::post('/courses/create', 'CoursesController@store');

Route::get('/courses/edit/{id}', 'CoursesController@edit');

Route::post('/courses/edit', 'CoursesController@update');

Route::post('/courses/edit/remove', 'CoursesController@remove');

Route::post('/courses/buy', 'CoursesController@buy');

Route::post('/courses/delete', 'CoursesController@destroy');

Route::get('/courses/take/{id}', 'CoursesController@take');

Route::post('/courses/take', 'CoursesController@answer');

Route::post('/apply', 'HomeController@apply');

Route::post('/settings/delete', 'HomeController@destroy');

Route::get('/coming', function () { // remove when released
    return view('coming');
});

Route::post('/notify', 'HomeController@notify'); // take away controller method when the website is released

/* 
    ------ Before Deployment
    * Change domain name
    * Change Email
    * Change Email driver to smtp
    * Disable Debug mode
    * Switch to Stripe public keys - verify account
    * Remove Unnecessary routes and views
    
    ------ To do
    * Delete Account
    * Email application - done
    * Redesign dashboard
    * Confirmation messages for updated resources
        + Dashboard
            - Buy course
            - Course created - could put on same page and redirect to edit
        + After application submit
    * Set up Stripe payment - done
        - Server side processing - done
        - Customized checkout form - done
    * Allow registration as a business - done
        - Send info in - manually reviewed
    * Make course management system
        - Create - done
            + What format for lessons/questions?
                - Videos, books, etc.
            + File storage - done
            + Right answer mark requirement
        - Edit - done
        - Delete - done
        - Buy course - done
        - Taking the course - done
            + Multiple choice
    * Make user settings system - done
        - Add more options?
    * Add error messages for forms - done?
        
    ------ Extras - not part of MVP
    * JS for client-side validation?
*/