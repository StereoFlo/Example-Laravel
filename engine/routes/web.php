<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/{index}', 'MainController@index')->where('index', '^(index\.html$|index\.jsp$|index\.php$)?');
Route::get('/login/ajax', 'Auth\\LoginController@ajaxLogin');
Route::get('/register/ajax', 'Auth\\RegisterController@ajaxRegister');
Route::get('/register', 'Auth\\RegisterController@register')->name('register');
Route::get('/news', 'NewsController@getList')->name('news');
Route::get('/news/page/{id}', 'NewsController@getList')->where('id', '[0-9]+');
Route::get('/news/{id}', 'NewsController@show')->where('id', '[0-9]+');
Route::get('/author/{id}', 'AuthorController@show')->where('id', '[0-9]+');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/manager/user/list', 'Manager\\User@getList')->name('managerUserList');
    Route::get('/manager/user/show/{userId}', 'Manager\\User@show')->where('userId', '[0-9]+')->name('managerUserShow');
    Route::get('/manager/user/role/add/{userId}/{roleId}', 'Manager\\User@addRole')
        ->where('userId', '[0-9]+')
        ->where('roleId', '[0-9]+')
        ->name('userRoleAddManager');
    Route::get('/manager/user/role/remove/{userId}/{roleId}', 'Manager\\User@removeRole')
        ->where('userId', '[0-9]+')
        ->where('roleId', '[0-9]+')
        ->name('userRoleRemoveManager');
});

Route::group(['middleware' => 'isModerator'], function () {
    Route::get('/manager', 'Manager\\ManagerController@index')->name('managerIndex');
    Route::get('/manager/slogan', 'Manager\\Slogan@index')->name('sloganIndex');
    Route::post('/manager/slogan/update', 'Manager\\Slogan@update')->name('sloganUpdate');
    Route::get('/manager/news', 'Manager\\News@getList')->name('newsList');
    Route::get('/manager/news/page/{id}', 'Manager\\News@getList')->where('id', '[0-9]+')->name('newsListPage');
    Route::get('/manager/news/new', 'Manager\\News@makeNew')->name('newsNew');
    Route::get('/manager/news/{id}/delete', 'Manager\\News@delete')->where('id', '[0-9]+')->name('newsDelete');
    Route::get('/manager/news/{id}/update', 'Manager\\News@update')->where('id', '[0-9]+')->name('newsUpdate');
    Route::post('/manager/news/process', 'Manager\\News@process')->name('newsProcess');
    Route::get('/manager/work/list', 'Manager\\Work@getUnapprovedList')->name('workListManager');
    Route::get('/manager/work/approve/{workId}', 'Manager\\Work@approve')->where('workId', '[0-9]+')->name('managerWorkApprove');
});

// profile change
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/profile', 'CabinetController@profile')->name('profileForm');
    Route::get('/cabinet/profile/avatar/remove', 'CabinetController@removeAvatar')->name('removeAvatar');
    Route::post('/cabinet/profile/update', 'CabinetController@profileUpdate')->name('profileUpdate');
});


// for author
Route::middleware('auth')->group(function () {
    Route::get('/cabinet', 'CabinetController@index')->name('cabinetIndex');
    Route::get('/cabinet/work/new', 'WorkController@add')->name('workAdd');
    Route::post('/cabinet/work/new/process', 'WorkController@process')->name('workProcess');
    Route::get('/cabinet/work/{id}/remove', 'WorkController@remove')->name('workRemove');
    Route::get('/cabinet/work/{id}/edit', 'WorkController@edit')->name('workEdit');
    Route::get('/cabinet/work/{id}/edit', 'WorkController@edit')->name('workEdit');
    Route::get('/cabinet/work/tag/remove/{workId}/{tagId}', 'TagController@deleteFromWork')
        ->where('workId', '[0-9]+')
        ->where('tagId', '[0-9]+')
        ->name('deleteFromWork');
    Route::get('/cabinet/work/{workId}/edit/removeImage/{imageId}', 'WorkController@removeImageFromWork')
        ->where('workId', '[0-9]+')
        ->where('imageId', '[0-9]+')
        ->name('imageDeleteFromWork');
    Route::get('/cabinet/work/{id}', 'WorkController@show')->name('workShow');
});