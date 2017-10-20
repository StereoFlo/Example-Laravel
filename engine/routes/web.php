<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');

// profile change
Route::middleware('auth')->group(function () {
    Route::get('/cabinet/profile', 'CabinetController@profile')->name('profileForm');
    Route::post('/cabinet/profile/update', 'CabinetController@profileUpdate')->name('profileUpdate');
});


// for author
Route::middleware('auth')->group(function () {
    Route::post('/cabinet/work', 'WorksController@workList')->name('workList');
    Route::post('/cabinet/work/new', 'WorksController@workAdd')->name('workAdd');
    Route::post('/cabinet/work/{id}/remove', 'WorksController@workRemove')->name('workRemove');
    Route::post('/cabinet/work/{id}/edit', 'WorksController@workEdit')->name('workEdit');
    Route::post('/cabinet/work/{id}', 'WorksController@workShow')->name('workShow');
});