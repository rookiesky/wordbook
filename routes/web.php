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

Route::get('/','HomeController@index');
Route::get('/article','HomeController@article');
Route::get('/reptile','Admin\ReptileController@index');




Route::group(['namespace'=>'Admin','prefix'=>'wp-book'],function (){

    Route::get('/login','LoginController@index');
    //Route::get('/create','LoginController@create');
    Route::post('/login','LoginController@login');

    Route::group(['middleware'=>'auth'],function (){
        Route::get('/logout','LoginController@logout');
        Route::get('/home','HomeController@index');

        Route::get('/sort','SortController@index');
        Route::get('/sort/create','SortController@create');
        Route::post('/sort/create','SortController@store');
        Route::get('/sort/{id}/edit','SortController@edit');
        Route::post('/sort/edit','SortController@update');
        Route::delete('/sort/{id}/delete','SortController@destroy');

        Route::get('/book/search','BookController@search');
        Route::get('/book/{id}','BookController@index');
        Route::get('/book/{id}/create','BookController@create');
        Route::post('/book/create','BookController@store');
        Route::get('/book/{id}/edit','BookController@edit');
        Route::post('/book/edit','BookController@update');
        Route::delete('/book/{id}/delete','BookController@destroy');

        Route::get('/system','SystemController@index');
        Route::post('/system','SystemController@store');
        Route::get('/system/link','LinksController@index');
        Route::get('/system/link/search','LinksController@search');
        Route::get('/system/link/create','LinksController@create');
        Route::post('/system/link','LinksController@store');
        Route::get('/system/link/{id}/edit','LinksController@edit');
        Route::post('/system/link/edit','LinksController@update');
        Route::delete('/system/link/{id}/delete','LinksController@destroy');

    });

});

