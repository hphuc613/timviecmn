<?php

use Illuminate\Support\Facades\Route;


Route::prefix("admin")->group(function () {
    Route::prefix("applicant")->group(function () {
        Route::get("/", "ApplicantController@index")->name("get.applicant.list")->middleware('can:applicant');
        Route::middleware('can:applicant-create')->group(function () {
            Route::get("/create", "ApplicantController@getCreate")->name("get.applicant.create");
            Route::post("/create", "ApplicantController@postCreate")->name("post.applicant.create");
            Route::get("/import", "ApplicantController@getImport")->name("get.applicant.import");
            Route::post("/import", "ApplicantController@postImport")->name("post.applicant.import");
        });
        Route::middleware('can:applicant-update')->group(function () {
            Route::get("/update/{id}", "ApplicantController@getUpdate")->name("get.applicant.update");
            Route::post("/update/{id}", "ApplicantController@postUpdate")->name("post.applicant.update");
            Route::get("/update-status/{id}", "ApplicantController@getUpdateStatus")->name("get.applicant.updateStatus");
        });
        Route::get("/delete/{id}", "ApplicantController@delete")
             ->name("get.applicant.delete")
             ->middleware('can:applicant-delete');
    });
});
