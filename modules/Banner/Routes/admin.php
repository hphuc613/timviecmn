<?php

use Illuminate\Support\Facades\Route;

Route::prefix("banner")->group(function () {
    Route::get("/", "BannerController@index")->name("get.banner.list")->middleware('can:banner');
    Route::middleware('can:banner-create')->group(function () {
        Route::get("create", "BannerController@getCreate")->name("get.banner.create");
        Route::post("create", "BannerController@postCreate")->name("post.banner.create");
    });
    Route::middleware('can:banner-update')->group(function () {
        Route::get("update/{id}", "BannerController@getUpdate")->name("get.banner.update");
        Route::post("update/{id}", "BannerController@postUpdate")->name("post.banner.update");
    });
    Route::get("delete/{id}", "BannerController@delete")->name("get.banner.delete")->middleware('can:banner-delete');
});
