<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * public routes
 */
Auth::routes();

Route::get('/{index}', 'MainController@index')->where('index', '^(index\.html$|index\.jsp$|index\.php$)?');

Route::get('/login/ajax', 'Auth\\LoginController@ajaxLogin');
Route::get('/register/ajax', 'Auth\\RegisterController@ajaxRegister');
Route::get('/register', 'Auth\\RegisterController@register')->name('register');

Route::get('/news', 'NewsController@getList')->name('news');
Route::get('/news/page/{id}', 'NewsController@getList')->where('id', '[0-9]+');
Route::get('/news/{id}', 'NewsController@show')->where('id', '[0-9]+');

Route::get('/author/{id}', 'AuthorController@show')->where('id', '[0-9]+')->name('authorPage');

Route::get('/work/{id}', 'WorkController@show')->where('id', '[0-9]+')->name('workPublicShow');
Route::get('/work/like/{id}', 'WorkController@setLike')->where('id', '[0-9]+')->name('workPublicLike');

Route::get('/gallery', 'GalleryController@index')->name('galleryPublicIndex');
Route::post('/gallery/works', 'GalleryController@getWorks')->name('galleryPublicWorks');

Route::get('/pages/{slug}.html', 'StaticPageController@getPage')->where('slug', '[a-z]+');


/**
 * Admin routes
 */
Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/manager/user/list', 'Manager\\UserController@getList')->name('managerUserList');
    Route::get('/manager/user/{id}/remove', 'Manager\\UserController@removeUser')->where('id', '[0-9]+')->name('managerUserRemove');
    Route::get('/manager/pages', 'Manager\\StaticPageController@getList')->name('managerPageList');
    Route::get('/manager/pages/new', 'Manager\\StaticPageController@makeNew')->name('managerPageNew');
    Route::post('/manager/pages/process', 'Manager\\StaticPageController@process')->name('managerPageProcess');
    Route::get('/manager/pages/{slug}/delete', 'Manager\\StaticPageController@remove')->where('slug', '[a-zA-Z0-9]+')->name('managerPageDelete');
    Route::get('/manager/pages/{slug}/edit', 'Manager\\StaticPageController@update')->where('slug', '[a-zA-Z0-9]+')->name('managerPageEdit');
    Route::get('/manager/user/show/{userId}', 'Manager\\UserController@show')->where('userId', '[0-9]+')->name('managerUserShow');
    Route::get('/manager/user/role/add/{userId}/{roleId}', 'Manager\\UserController@addRole')
        ->where('userId', '[0-9]+')
        ->where('roleId', '[0-9]+')
        ->name('userRoleAddManager');
    Route::get('/manager/user/role/remove/{userId}/{roleId}', 'Manager\\UserController@removeRole')
        ->where('userId', '[0-9]+')
        ->where('roleId', '[0-9]+')
        ->name('userRoleRemoveManager');
    Route::get('/manager/settings', 'Manager\\SettingsController@form')->name('managerSettingsForm');
    Route::post('/manager/settings/process', 'Manager\\SettingsController@process')->name('managerSettingsProcess');
});

/**
 * Moderator routes
 */
Route::group(['middleware' => 'isModerator'], function () {
    Route::get('/manager', 'Manager\\ManagerController@index')->name('managerIndex');
    Route::get('/manager2/{any}', 'Manager\\ManagerController@manager2')->where('any', '.*');
    Route::get('/manager2', 'Manager\\ManagerController@manager2');

    Route::get('/manager/news', 'Manager\\NewsController@getList')->name('newsList');
    Route::get('/manager/news/page/{id}', 'Manager\\NewsController@getList')->where('id', '[0-9]+')->name('newsListPage');
    Route::get('/manager/news/new', 'Manager\\NewsController@makeNew')->name('newsNew');
    Route::get('/manager/news/{id}/delete', 'Manager\\NewsController@delete')->where('id', '[0-9]+')->name('newsDelete');
    Route::get('/manager/news/{id}/update', 'Manager\\NewsController@update')->where('id', '[0-9]+')->name('newsUpdate');
    Route::post('/manager/news/process', 'Manager\\NewsController@process')->name('newsProcess');

    Route::get('/manager/work/list/unapproved', 'Manager\\WorkController@getListUnapproved')->name('workListUnapprovedManager');
    Route::get('/manager/work/list/approved', 'Manager\\WorkController@getListApproved')->name('workListManagerApproved');
    Route::get('/manager/work/list/author/{id}', 'Manager\\WorkController@getListByAuthor')->where('id', '[0-9]+')->name('workListAuthorManager');
    Route::get('/manager/work/list', 'Manager\\WorkController@getList')->name('workListManager');
    Route::get('/manager/work/list/{pageId}', 'Manager\\WorkController@getList')->where('id', '[0-9]+')->name('workListManagerPage');
    Route::get('/manager/work/approve/{workId}', 'Manager\\WorkController@approve')->where('workId', '[0-9]+')->name('managerWorkApprove');
    Route::get('/manager/work/{workId}/remove', 'Manager\\WorkController@remove')->where('workId', '[0-9]+')->name('managerWorkRemove');

    Route::get('/manager/catalog/list', 'Manager\\CatalogController@getList')->name('managerCatalogList');
    Route::get('/manager/catalog/add', 'Manager\\CatalogController@form')->name('managerCatalogAdd');
    Route::post('/manager/catalog/process', 'Manager\\CatalogController@process')->name('managerCatalogProcess');
    Route::get('/manager/catalog/{id}/edit', 'Manager\\CatalogController@form')->where('id', '[0-9]+')->name('managerCatalogEdit');
    Route::get('/manager/catalog/{id}/remove', 'Manager\\CatalogController@remove')->where('id', '[0-9]+')->name('managerCatalogRemove');

    Route::get('/manager/material/list', 'Manager\\MaterialController@getList')->name('managerMaterialList');
    Route::get('/manager/material/add', 'Manager\\MaterialController@add')->name('managerMaterialAdd');
    Route::get('/manager/material/{id}/edit', 'Manager\\MaterialController@edit')->where('id', '[0-9]+')->name('managerMaterialAdd');
    Route::get('/manager/material/{id}/edit', 'Manager\\MaterialController@edit')->where('id', '[0-9]+')->name('managerMaterialEdit');
    Route::get('/manager/material/{id}/remove', 'Manager\\MaterialController@remove')->where('id', '[0-9]+')->name('managerMaterialRemove');
    Route::post('/manager/material/process', 'Manager\\MaterialController@process')->name('managerMaterialProcess');
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
    Route::get('/cabinet/work/tag/remove/{workId}/{tagId}', 'TagController@deleteFromWork')
        ->where('workId', '[0-9]+')
        ->where('tagId', '[0-9]+')
        ->name('deleteFromWork');
    Route::get('/cabinet/work/material/remove/{workId}/{materialId}', 'WorkController@removeMaterialFromWork')
        ->where('workId', '[0-9]+')
        ->where('materialId', '[0-9]+')
        ->name('removeMaterialFromWork');
    Route::get('/cabinet/work/category/remove/{workId}/{catId}', 'WorkController@removeFromCategory')
        ->where('workId', '[0-9]+')
        ->where('catId', '[0-9]+')
        ->name('deleteFromCategory');
    Route::get('/cabinet/work/{workId}/edit/removeImage/{imageId}', 'WorkController@removeImageFromWork')
        ->where('workId', '[0-9]+')
        ->where('imageId', '[0-9]+')
        ->name('imageDeleteFromWork');
    Route::get('/cabinet/work/{id}', 'WorkController@show')->where('id', '[0-9]+')->name('workShow');

    Route::get('/work/set_default_image/{workId}/{imageId}', 'WorkController@setDefaultImage')
        ->where('workId', '[0-9]+')
        ->where('imageId', '[0-9]+')
        ->name('setDefaultImage');
});