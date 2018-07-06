<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'isModerator'], function () {
    Route::get('/manager/catalog/list', 'Manager\\Api\\Catalog@getList');
});
