<?php
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("position")->group(function () {
        Route::get("/", "PositionController@index")->name("get.position.list")->middleware('can:position');
        Route::middleware('can:position-create')->group(function () {
            Route::get("/create", "PositionController@getCreate")->name("get.position.create");
            Route::post("/create", "PositionController@postCreate")->name("post.position.create");
        });
        Route::middleware('can:position-update')->group(function () {
            Route::get("/update/{id}", "PositionController@getUpdate")->name("get.position.update");
            Route::post("/update/{id}", "PositionController@postUpdate")->name("post.position.update");
        });
        Route::get("/delete/{id}", "PositionController@delete")->name("get.position.delete")->middleware('can:position-delete');
    });
});
