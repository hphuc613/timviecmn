<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'FrontendController@index')->name('get.frontend.home');
Route::get('recruit', 'FrontendController@getRecruit')->name('get.frontend.recruit');
Route::post('recruit', 'FrontendController@postRecruit')->name('post.frontend.recruit');
Route::post('apply-job/{id}-{slug}', 'FrontendController@postApplyJob')->name('post.frontend.apply');
Route::get('news', 'FrontendController@newsListing')->name('get.frontend.listing');
Route::get('news/detail/{id}-{slug}', 'FrontendController@newsDetail')->name('get.frontend.detail');
