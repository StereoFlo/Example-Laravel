<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['middleware' => 'isModerator'], function () {
        Route::get('/manager/catalog/list', 'Manager\\Api\\CatalogController@getList');
        Route::get('/manager/catalog/{categoryId}', 'Manager\\Api\\CatalogController@show')->where('categoryId', '[0-9]+');
        Route::post('/manager/catalog/process', 'Manager\\Api\\CatalogController@process');
        Route::get('/manager/catalog/{id}/remove', 'Manager\\Api\\CatalogController@remove')->where('id', '[0-9]+');

        Route::get('/manager/settings/list', 'Manager\\Api\\SettingsController@getList');
        Route::post('/manager/settings/process', 'Manager\\Api\\SettingsController@process');

        Route::get('/manager/material/list', 'Manager\\Api\\MaterialController@getList');
        Route::post('/manager/material/process', 'Manager\\Api\\MaterialController@process');
        Route::get('/manager/material/{id}/remove', 'Manager\\Api\\MaterialController@remove')->where('id', '[0-9]+');

        Route::get('/manager/pages/list', 'Manager\\Api\\StaticPageController@getList');
        Route::get('/manager/pages/{pageId}', 'Manager\\Api\\StaticPageController@show')->where('pageId', '[a-zA-Z0-9]+');
        Route::get('/manager/pages/{slug}/delete', 'Manager\\Api\\StaticPageController@remove')->where('slug', '[a-zA-Z0-9]+');
        Route::post('/manager/pages/process', 'Manager\\Api\\StaticPageController@process');

        Route::get('/manager/news/list', 'Manager\\Api\\NewsController@getList');
        Route::get('/manager/news/list/{id}', 'Manager\\Api\\NewsController@getList')->where('id', '[0-9]+');
        Route::get('/manager/news/{newsId}', 'Manager\\Api\\NewsController@show')->where('newsId', '[0-9]+');
        Route::get('/manager/news/{id}/delete', 'Manager\\Api\\NewsController@delete')->where('id', '[0-9]+');
        Route::post('/manager/news/process', 'Manager\\Api\\NewsController@process');

        Route::get('/manager/work/list/unapproved', 'Manager\\Api\\WorkController@getListUnapproved');
        Route::get('/manager/work/list/approved', 'Manager\\Api\\WorkController@getListApproved');
        Route::get('/manager/work/list/author/{id}', 'Manager\\Api\\WorkController@getListByAuthor')->where('id', '[0-9]+');
        Route::get('/manager/work/list', 'Manager\\Api\\WorkController@getList');
        Route::get('/manager/work/list/{pageId}', 'Manager\\Api\\WorkController@getList')->where('id', '[0-9]+');
        Route::get('/manager/work/approve/{workId}', 'Manager\\Api\\WorkController@approve')->where('workId', '[0-9]+');
        Route::get('/manager/work/{workId}/delete', 'Manager\\Api\\WorkController@remove')->where('workId', '[0-9]+');
        Route::get('/manager/work/approve/{workId}', 'Manager\\WorkController@approve')->where('workId', '[0-9]+');

        Route::get('/manager/user/list', 'Manager\\Api\\UserController@getList');
        Route::get('/manager/user/{userId}', 'Manager\\Api\\UserController@show')->where('userId', '[0-9]+');
        Route::get('/manager/user/role/add/{userId}/{roleId}', 'Manager\\Api\\UserController@addRole')
            ->where('userId', '[0-9]+')
            ->where('roleId', '[0-9]+');
        Route::get('/manager/user/role/remove/{userId}/{roleId}', 'Manager\\Api\\UserController@removeRole')
            ->where('userId', '[0-9]+')
            ->where('roleId', '[0-9]+');
        Route::get('/manager/user/{id}/remove', 'Manager\\UserController@removeUser')->where('id', '[0-9]+');
    });
});
