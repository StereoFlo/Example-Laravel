<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/{index}', 'MainController@index')->where('index', '^(index\.html$|index\.jsp$|index\.php$)?');
Route::get('/login/ajax', 'Auth\\LoginController@ajaxLogin');
Route::get('/register/ajax', 'Auth\\RegisterController@ajaxRegister');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/manager/user/list', 'Manager\\User@list')->name('managerUserList');
    Route::get('/manager/user/show/{userId}', 'Manager\\User@show')->where('userId', '[0-9]+')->name('managerUserShow');
    Route::get('/manager/user/role/add/{userId}/{roleId}', 'Manager\\User@addRole')->where('userId', '[0-9]+')->where('roleId', '[0-9]+');
    Route::get('/manager/user/role/remove/{userId}/{roleId}', 'Manager\\User@removeRole')->where('userId', '[0-9]+')->where('roleId', '[0-9]+');
    Route::get('/manager/page/list', 'Manager\\StaticPage@getList');
    Route::get('/manager/page/{id}', 'Manager\\StaticPage@getById')->where('id', '[0-9]+');
    Route::get('/manager/page/{id}/remove', 'Manager\\StaticPage@deleteById')->where('id', '[0-9]+');
    Route::get('/manager/slogan', 'Manager\\SloganController@index')->name('sloganIndex');
    Route::post('/manager/slogan/update', 'Manager\\SloganController@update')->name('sloganUpdate');
});

Route::group(['middleware' => 'isModerator', 'isModerator'], function () {
    Route::get('/manager/icon/list', 'Manager\\Icon@list');
});

// profile change
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/profile', 'CabinetController@profile')->name('profileForm');
    Route::get('/cabinet/profile/avatar/remove', 'CabinetController@removeAvatar')->name('removeAvatar');
    Route::post('/cabinet/profile/update', 'CabinetController@profileUpdate')->name('profileUpdate');
});


// for author
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/work', 'WorkController@getList')->name('workList');
    Route::get('/cabinet/work/new', 'WorkController@add')->name('workAdd');
    Route::post('/cabinet/work/new/process', 'WorkController@addProcess')->name('workAddProcess');
    Route::get('/cabinet/work/{id}/remove', 'WorkController@remove')->name('workRemove');
    Route::get('/cabinet/work/{id}/edit', 'WorkController@edit')->name('workEdit');
    Route::get('/cabinet/work/{workId}/edit/removeImage/{imageId}', 'WorkController@removeImageFromWork')
        ->where('workId', '[0-9]+')
        ->where('imageId', '[0-9]+')
        ->name('imageDeleteFromWork');
    Route::get('/cabinet/work/{id}', 'WorkController@show')->name('workShow');
});