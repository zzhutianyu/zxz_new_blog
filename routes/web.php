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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('admin/index', function () {
    return view('admin.index');

});

//admin
Route::group(['middleware' => ['api.auth']], function () {
    Route::post('/upload/image', "ImageController@upload");
    Route::post('/upload/music', "MusicController@upload");
    Route::post('/upload/post', "PostController@upload");
    Route::post('/upload/post/edit', "PostController@edit");
    Route::get('links', 'LinkController@links');
    Route::get('link/id', 'LinkController@getNewLinkId');
    Route::post('delete/link', 'LinkController@delete');
    Route::post('update/link/name', 'LinkController@changeName');
    Route::post('update/link/url', 'LinkController@changeUrl');
    Route::get('visits', 'VisitController@visits');
    Route::get('/test/posts', 'PostController@getPosts');
    Route::get('/post', 'PostController@getPost');
});
//

// view
Route::get('/', 'ViewController@index')->name('index');
Route::get('/about', 'ViewController@about');
Route::get('/archive', 'ViewController@archive');
Route::get('/post/{post_id}', 'ViewController@post')->name('post');
Route::get('/link', 'ViewController@link');
// end view

//from
Route::post('/about/post', 'CommentController@aboutFeedBack')->name('about-comment');
Route::post('/post/comment', 'CommentController@postComment')->name('post-comment');
//endfrom

//post
Route::post('/post/like', 'PostController@updateLike');
//end post

Route::post('/admin/login', 'AdminController@login');

//test







//Route::post('delete/link', 'LinkController@delete');

Route::get('index/img', 'ImageController@indexImage');


