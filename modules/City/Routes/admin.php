<?php
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("city")->group(function () {
        Route::get("/", "CityController@index")->name("get.city.list")->middleware('can:city');
        Route::middleware('can:city-create')->group(function () {
            Route::get("/create", "CityController@getCreate")->name("get.city.create");
            Route::post("/create", "CityController@postCreate")->name("post.city.create");
        });
        Route::middleware('can:city-update')->group(function () {
            Route::get("/sync-api", "CityController@syncApi")->name("get.city.syncApi");
            Route::get("/update/{id}", "CityController@getUpdate")->name("get.city.update");
            Route::post("/update/{id}", "CityController@postUpdate")->name("post.city.update");
        });
        Route::get("/delete/{id}", "CityController@delete")->name("get.city.delete")->middleware('can:city-delete');


    });
});
