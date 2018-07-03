<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['middleware' => 'isModerator'], function () {
        Route::get('/manager/catalog/list', 'Manager\\Api\\Catalog@getList');
        Route::post('/manager/catalog/process', 'Manager\\Api\\Catalog@process');
        Route::get('/manager/catalog/{id}/remove', 'Manager\\Api\\Catalog@remove')->where('id', '[0-9]+');
    });
});
