<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'MainController@index')->where('index','^(index\.html$|index\.jsp$|index\.php$)?');
Route::get('/login/ajax', 'Auth\\LoginController@ajaxLogin');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/manager/user/list', 'Manager\\User@list');
    Route::get('/manager/user/show/{id}', 'Manager\\User@show')->where('id', '[0-9]+');
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
    Route::get('/cabinet/work', 'WorkController@workList')->name('workList');
    Route::get('/cabinet/work/new', 'WorkController@workAdd')->name('workAdd');
    Route::post('/cabinet/work/new/process', 'WorkController@workAddProcess')->name('workAddProcess');
    Route::get('/cabinet/work/{id}/remove', 'WorkController@workRemove')->name('workRemove');
    Route::get('/cabinet/work/{id}/edit', 'WorkController@workEdit')->name('workEdit');
    Route::get('/cabinet/work/{id}', 'WorkController@workShow')->name('workShow');
});