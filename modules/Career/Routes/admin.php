<?php
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("career")->group(function () {
        Route::get("/", "CareerController@index")->name("get.career.list")->middleware('can:career');
        Route::middleware('can:career-create')->group(function () {
            Route::get("/create", "CareerController@getCreate")->name("get.career.create");
            Route::post("/create", "CareerController@postCreate")->name("post.career.create");
        });
        Route::middleware('can:career-update')->group(function () {
            Route::get("/update/{id}", "CareerController@getUpdate")->name("get.career.update");
            Route::post("/update/{id}", "CareerController@postUpdate")->name("post.career.update");
        });
        Route::get("/delete/{id}", "CareerController@delete")->name("get.career.delete")->middleware('can:career-delete');
    });
});
