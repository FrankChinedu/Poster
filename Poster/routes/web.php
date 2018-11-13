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
Route::post('/posts/create/text', 'PostController@createPost')->name('post-add-text');
Route::post('/posts/delete/{id}', 'PostController@delete')->name('post-delete');
Route::get('/posts/show/{id}', 'PostController@show')->name('post-show');

Route::post('/video/create/video', 'VideoController@createVideo')->name('add-video');
Route::get('/video/show/{id}', 'VideoController@show')->name('video-show');
Route::post('/video/delete/{id}', 'VideoController@delete')->name('video-delete');
// COMMENTS
Route::post('/comment/create/post/{post_id}', 'CommentController@addPostComment')->name('create-post-comment');
Route::post('/comment/create/video/{id}', 'CommentController@addVideoComment')->name('create-video-comment');
Route::post('/comment/delete/{comment_id}', 'CommentController@delete')->name('comment-delete');
