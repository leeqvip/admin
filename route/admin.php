<?php

Route::group('auth', function () {
    Route::get('/passport/login', 'auth\\Passport@login')->name('techadmin.auth.passport.login');
    Route::post('/passport/login', 'auth\\Passport@loginAuth');

    Route::get('/passport/logout', 'auth\\Passport@logout')->name('techadmin.auth.passport.logout')->middleware('techadmin.admin');
    Route::get('/passport/user', 'auth\\Passport@user')->name('techadmin.auth.passport.user')->middleware('techadmin.admin');
});

Route::group([
    'middleware' => ['techadmin.admin'],
], function () {
    Route::group('auth', function () {

        // 管理员
        Route::get('/adminer/delete', 'auth\\Adminer@delete')->name('techadmin.auth.adminer.delete');
        Route::get('/adminer/edit', 'auth\\Adminer@edit')->name('techadmin.auth.adminer.edit');
        Route::post('/adminer/edit', 'auth\\Adminer@save');
        Route::get('/adminer', 'auth\\Adminer@index')->name('techadmin.auth.adminer');

        // 角色
        Route::get('/role/delete', 'auth\\Role@delete')->name('techadmin.auth.role.delete');
        Route::get('/role/edit', 'auth\\Role@edit')->name('techadmin.auth.role.edit');
        Route::post('/role/edit', 'auth\\Role@save');
        Route::get('/role', 'auth\\Role@index')->name('techadmin.auth.role');

        // 权限
        Route::get('/permission/delete', 'auth\\Permission@delete')->name('techadmin.auth.permission.delete');
        Route::get('/permission/edit', 'auth\\Permission@edit')->name('techadmin.auth.permission.edit');
        Route::post('/permission/edit', 'auth\\Permission@save');
        Route::get('/permission', 'auth\\Permission@index')->name('techadmin.auth.permission');

        Route::get('/log', 'auth\\Log@index')->name('techadmin.log');
    });

    // 首页
    Route::get('/', 'Index@index')->name('techadmin.index');
    Route::get('/dashboard', 'Index@index');

    Route::get('/config/add', 'Config@add')->name('techadmin.config.add');
    Route::post('/config/add', 'Config@create');
    Route::get('/config', 'Config@index')->name('techadmin.config');
    Route::post('/config', 'Config@save');

    // 分类
    Route::get('/category/delete', 'Category@delete')->name('techadmin.category.delete');
    Route::get('/category/edit', 'Category@edit')->name('techadmin.category.edit');
    Route::post('/category/edit', 'Category@save');
    Route::get('/category', 'Category@index')->name('techadmin.category');

    // 文章
    Route::get('/article/delete', 'Article@delete')->name('techadmin.article.delete');
    Route::get('/article/edit', 'Article@edit')->name('techadmin.article.edit');
    Route::post('/article/edit', 'Article@save');
    Route::get('/article', 'Article@index')->name('techadmin.article');

    // 单页
    Route::get('/single/delete', 'Single@delete')->name('techadmin.single.delete');
    Route::get('/single/edit', 'Single@edit')->name('techadmin.single.edit');
    Route::post('/single/edit', 'Single@save');
    Route::get('/single', 'Single@index')->name('techadmin.single');
});
