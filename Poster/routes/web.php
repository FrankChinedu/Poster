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

Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// POSTS
Route::get('/posts', 'PostController@index')->name('post-index');
Route::get('/posts/create', 'PostController@create')->name('post-create');
Route::post('/posts/create', 'PostController@add')->name('post-add');
Route::post('/posts/delete/{id}', 'PostController@delete')->name('post-delete');
Route::get('/posts/show/{id}', 'PostController@show')->name('post-show');

// COMMENTS
Route::post('/comment/create/{post_id}', 'CommentController@add')->name('comment-create');
Route::post('/comment/delete/{comment_id}', 'CommentController@delete')->name('comment-delete');
