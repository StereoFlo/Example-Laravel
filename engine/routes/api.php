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

        Route::get('/manager/pages/list', 'Manager\\Api\\StaticPage@getList');
        Route::get('/manager/pages/{slug}/delete', 'Manager\\Api\\StaticPage@remove')->where('slug', '[a-zA-Z0-9]+');
        Route::post('/manager/pages/process', 'Manager\\Api\\StaticPage@process');

        Route::get('/manager/news/list', 'Manager\\Api\\News@getList');
        Route::get('/manager/news/list/{id}', 'Manager\\Api\\News@getList')->where('id', '[0-9]+');
        Route::get('/manager/news/{id}/delete', 'Manager\\Api\\News@delete')->where('id', '[0-9]+');
        Route::post('/manager/news/process', 'Manager\\Api\\News@process');

        Route::get('/manager/work/list/unapproved', 'Manager\\Api\\Work@getListUnapproved');
        Route::get('/manager/work/list/approved', 'Manager\\Api\\Work@getListApproved');
        Route::get('/manager/work/list/author/{id}', 'Manager\\Api\\Work@getListByAuthor')->where('id', '[0-9]+');
        Route::get('/manager/work/list', 'Manager\\Api\\Work@getList');
        Route::get('/manager/work/list/{pageId}', 'Manager\\Api\\Work@getList')->where('id', '[0-9]+');
        Route::get('/manager/work/approve/{workId}', 'Manager\\Api\\Work@approve')->where('workId', '[0-9]+');
        Route::get('/manager/work/{workId}/delete', 'Manager\\Api\\Work@remove')->where('workId', '[0-9]+');
    });
});
