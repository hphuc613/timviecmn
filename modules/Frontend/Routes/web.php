<?php
use Illuminate\Support\Facades\Route;

Route::get('', 'FrontendController@index')->name('get.frontend.home');
Route::get('recruit', 'FrontendController@getRecruit')->name('get.frontend.recruit');
Route::post('recruit', 'FrontendController@postRecruit')->name('post.frontend.recruit');
