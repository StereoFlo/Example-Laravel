<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'MainController@index');

Route::group(['middleware' => 'isAdminRole'], function () {
    Route::get('/manager/user/list', 'AdminController@userList');
});

// profile change
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/profile', 'CabinetController@profile')->name('profileForm');
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