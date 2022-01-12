<?php

use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::prefix("setting")->group(function () {
        Route::get("/", "SettingController@index")->name("get.setting.list");
        Route::get("/email", "SettingController@emailConfig")->name("get.setting.emailConfig");
        Route::post("/email", "SettingController@emailConfig")->name("post.setting.emailConfig");
        Route::get("/test-email", "SettingController@testSendMail")->name("get.setting.testSendMail");
        Route::get("/website", "SettingController@getWebsiteConfig")->name("get.setting.websiteConfig");
        Route::post("/website", "SettingController@postWebsiteConfig")->name("post.setting.websiteConfig");
    });
});
