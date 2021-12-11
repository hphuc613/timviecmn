<?php
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("company")->group(function () {
        Route::get("/", "CompanyController@index")->name("get.company.list")->middleware('can:company');
        Route::middleware('can:company-create')->group(function () {
            Route::get("/create", "CompanyController@getCreate")->name("get.company.create");
            Route::post("/create", "CompanyController@postCreate")->name("post.company.create");
        });
        Route::middleware('can:company-update')->group(function () {
            Route::get("/update/{id}", "CompanyController@getUpdate")->name("get.company.update");
            Route::post("/update/{id}", "CompanyController@postUpdate")->name("post.company.update");
        });
        Route::get("/delete/{id}", "CompanyController@delete")->name("get.company.delete")->middleware('can:company-delete');
    });
});
