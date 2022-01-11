<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("page")->group(function () {
        Route::get("/", "PageController@index")->name("get.page.list")->middleware('can:page');
        Route::group(['middleware' => 'can:page-create'], function () {
            Route::get('/create', 'PageController@getCreate')->name('get.page.create');
            Route::post('/create', 'PageController@postCreate')->name('post.page.create');
        });
        Route::group(['middleware' => 'can:page-update'], function () {
            Route::get('/update/{id}', 'PageController@getUpdate')->name('get.page.update');
            Route::post('/update/{id}', 'PageController@postUpdate')->name('post.page.update');
        });
        Route::get('/delete/{id}', 'PageController@delete')->name('get.page.delete')->middleware('can:page-delete');
    });
    Route::prefix("home")->group(function () {
        Route::get("/", "HomeController@index")->name("get.home.list")->middleware('can:home');
        Route::group(['middleware' => 'can:home-update'], function () {
            Route::get('banner', 'HomeController@updateHome')->name('get.home_banner.update');
            Route::post('banner', 'HomeController@updateHome')->name('post.home_banner.update');
            Route::get('product', 'HomeController@updateProduct')->name('get.home_product.update');
            Route::post('product', 'HomeController@updateProduct')->name('post.home_product.update');
            Route::get('catalog-left', 'HomeController@updateHome')->name('get.home_catalog_left.update');
            Route::post('catalog-left', 'HomeController@updateHome')->name('post.home_catalog_left.update');
            Route::get('catalog-right', 'HomeController@updateHome')->name('get.home_catalog_right.update');
            Route::post('catalog-right', 'HomeController@updateHome')->name('post.home_catalog_right.update');
            Route::get('story', 'HomeController@updateHome')->name('get.home_story.update');
            Route::post('story', 'HomeController@updateHome')->name('post.home_story.update');
        });
    });
});

