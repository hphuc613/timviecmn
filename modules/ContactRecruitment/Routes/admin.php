<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("contact_recruitment")->group(function () {
        Route::get("/", "ContactRecruitmentController@index")->name("get.contact_recruitment.list")->middleware('can:contact_recruitment');
        Route::get("/view/{id}", "ContactRecruitmentController@getView")->name("get.contact_recruitment.view");
        Route::middleware('can:contact_recruitment-create')->group(function () {
            Route::get("/create", "ContactRecruitmentController@getCreate")->name("get.contact_recruitment.create");
            Route::post("/create", "ContactRecruitmentController@postCreate")->name("post.contact_recruitment.create");
        });
        Route::middleware('can:contact_recruitment-update')->group(function () {
            Route::get("/update/{id}", "ContactRecruitmentController@getUpdate")->name("get.contact_recruitment.update");
            Route::post("/update/{id}", "ContactRecruitmentController@postUpdate")->name("post.contact_recruitment.update");
            Route::get("/update-status/{id}", "ContactRecruitmentController@getUpdateStatus")->name("get.contact_recruitment.updateStatus");
        });
        Route::get("/delete/{id}", "ContactRecruitmentController@delete")->name("get.contact_recruitment.delete")->middleware('can:contact_recruitment-delete');
    });
});
