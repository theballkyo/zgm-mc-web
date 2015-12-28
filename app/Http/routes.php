<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web', 'minecraft']], function () {
    Route::auth();

    Route::get('/', 'HomeController@welcome');
    Route::get('/home', 'HomeController@index');
    Route::resource('category', 'CategoryController');

	Route::get('/topic/delete/{id}', 'TopicController@deleteConfirm');
    Route::get('/topic/reply/{id}', 'TopicController@reply');
    Route::post('/topic/reply', 'TopicController@storeReply');
    Route::get('/topic/reply', 'TopicController@replyRedirect');
    Route::resource('topic', 'TopicController');

    // Route::resource('comment', 'CategoryController');
});
