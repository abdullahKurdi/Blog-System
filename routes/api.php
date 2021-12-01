<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('posts', 'Frontend\PostController@index');
Route::apiResource('posts', 'Frontend\PostController');
Route::apiResource('categories', 'Frontend\CategoryController');
Route::get('category/{slug}/posts', 'Frontend\PostController@categoryPost');
Route::get('search-post/{query}', 'Frontend\PostController@searchPost');

Route::post('/login' , 'Frontend\AuthController@login');
Route::post('/register' , 'Frontend\AuthController@register');
Route::group(['middleware'=>'auth:api'],function(){
    Route::get('user',  'Frontend\AuthController@authenticatedUserDetails');
    Route::post('comment/create',  'Frontend\CommentController@store');

});

Route::group(['prefix'=>'admin' , 'middleware'=>'auth:api'] ,function (){
    Route::get('/posts' ,       ['as'=>'admin.getPost',            'uses'=>'Frontend\AdminController@getPost']);
    Route::get('/categories' ,  ['as'=>'admin.getCategory',        'uses'=>'Frontend\AdminController@getCategory']);

    Route::post('/add-post' ,       ['as'=>'admin.addPost',             'uses'=>'Frontend\AdminController@addPost']);
    Route::post('/update-post' ,    ['as'=>'admin.updatePost',             'uses'=>'Frontend\AdminController@updatePost']);
    Route::post('/delete-posts' ,   ['as'=>'admin.deletePost',             'uses'=>'Frontend\AdminController@deletePosts']);

});
