<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['middleware' => 'isModerator'], function () {
        Route::get('/manager/catalog/list', 'Manager\\Api\\Catalog@getList');
        Route::post('/manager/catalog/process', 'Manager\\Api\\Catalog@process');
        Route::get('/manager/catalog/{id}/remove', 'Manager\\Api\\Catalog@remove')->where('id', '[0-9]+');
        Route::get('/manager/settings/list', 'Manager\\Api\\Settings@getList');
        Route::post('/manager/settings/process', 'Manager\\Api\\Settings@process');
        Route::get('/manager/material/list', 'Manager\\Api\\Material@getList');
        Route::post('/manager/material/process', 'Manager\\Api\\Material@process');
        Route::get('/manager/material/{id}/remove', 'Manager\\Api\\Material@remove')->where('id', '[0-9]+');
    });
});
