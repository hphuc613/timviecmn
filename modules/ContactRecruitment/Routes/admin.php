<?php
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("contactrecruitment")->group(function () {
        Route::get("/", "ContactRecruitmentController@index")->name("get.contactrecruitment.list")->middleware('can:contactrecruitment');
        Route::middleware('can:contactrecruitment-create')->group(function () {
            Route::get("/create", "ContactRecruitmentController@getCreate")->name("get.contactrecruitment.create");
            Route::post("/create", "ContactRecruitmentController@postCreate")->name("post.contactrecruitment.create");
        });
        Route::middleware('can:contactrecruitment-update')->group(function () {
            Route::get("/update/{id}", "ContactRecruitmentController@getUpdate")->name("get.contactrecruitment.update");
            Route::post("/update/{id}", "ContactRecruitmentController@postUpdate")->name("post.contactrecruitment.update");
        });
        Route::get("/delete/{id}", "ContactRecruitmentController@delete")->name("get.contactrecruitment.delete")->middleware('can:contactrecruitment-delete');
    });
});
