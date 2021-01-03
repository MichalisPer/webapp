<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', 'App\Http\Controllers\HomeController@adminIndex')->name('admin.index');
    Route::get('/admin/{post}', 'App\Http\Controllers\HomeController@adminShow')->name('admin.show');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/posts/new', 'App\Http\Controllers\PostController@create')->name('posts.create');
    Route::post('/posts/new', 'App\Http\Controllers\PostController@store')->name('posts.store');
    Route::post('/comments/new', 'App\Http\Controllers\CommentController@store')->name('comments.store');
    Route::get('/posts/edit/{post}', 'App\Http\Controllers\PostController@edit')->name('posts.edit');
    Route::post('/posts/edit/{post}', 'App\Http\Controllers\PostController@update')->name('posts.update');
    Route::delete('/posts/edit/{post}', 'App\Http\Controllers\PostController@destroy')->name('posts.destroy');
    Route::get('/comments/edit/{comment}', 'App\Http\Controllers\CommentController@edit')->name('comments.edit');
    Route::post('/comments/edit/{comment}', 'App\Http\Controllers\CommentController@update')->name('comments.update');
    Route::delete('/comments/edit/{comment}', 'App\Http\Controllers\CommentController@destroy')->name('comments.destroy');
    Route::get('/profile/edit/{profile}', 'App\Http\Controllers\ProfileController@edit')->name('profiles.edit');
    Route::post('/profile/edit/{profile}', 'App\Http\Controllers\ProfileController@update')->name('profiles.update');
});

Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('posts.show');
Route::get('/tags/{tag}', 'App\Http\Controllers\TagController@show')->name('tags.show');
Route::get('/profile/{profile}', 'App\Http\Controllers\ProfileController@show')->name('profiles.show');
