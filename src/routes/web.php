<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin',], function () {
    //登录页
    Route::get('login', 'Auth\AuthController@showLoginForm')->name('admin.login');
    //登录提交
    Route::post('postLogin', 'Auth\AuthController@login')->name('admin.postLogin');
    //退出
    Route::get('logout', 'Auth\AuthController@logout')->name('admin.logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        // 控制台
        Route::get('/', 'BaseController@index')->name('admin.index');

        // 系统管理
        Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {
            // 站点设置
            Route::get('site', 'SiteController@getIndex')->name('admin.system.site');

            // 保存设置
            Route::post('site/save', 'SiteController@postIndex')->name('admin.system.site.save');

            // 菜单管理
            Route::get('menu', 'MenuController@getIndex')->name('admin.system.menu');

            // 新增菜单
            Route::get('menu/add/{pid?}', 'MenuController@getAdd')->name('admin.system.menu.add');

            // 保存新增菜单
            Route::post('menu/postAdd', 'MenuController@postAdd')
                ->name('admin.system.menu.postAdd');

            // 编辑路由
            Route::get('menu/{id}/edit', 'MenuController@getEdit')
                ->name('admin.system.menu.edit');

            // 保存编辑菜单
            Route::post('menu/{id}/edit', 'MenuController@postEdit')
                ->name('admin.system.menu.postEdit');

            // 删除菜单
            Route::get('menu/{id}/delete', 'MenuController@getDelete')
                ->name('admin.system.menu.delete');
        });

        //用户管理
        Route::group(['prefix' => 'users', 'namespace' => 'Users'], function () {
            //用户列表
            Route::get('user', 'UserController@getIndex')->name('admin.users.user');

            // 添加用户
            Route::get('user/add', 'UserController@getAdd')->name('admin.users.user.add');

            // 编辑用户
            Route::get('user/{uid}/edit', 'UserController@getEdit')->name('admin.users.user.edit');

            // 保存添加用户
            Route::post('user/postAdd', 'UserController@postAdd')->name('admin.users.user.postAdd');

            // 保存编辑用户
            Route::post('user/{uid}/edit', 'UserController@postEdit')
                ->name('admin.users.user.postEdit');

            // 删除用户
            Route::get('user/{uid}/delete', 'UserController@getDelete')
                ->name('admin.users.user.delete');

            //角色管理
            Route::get('role', 'RoleController@getIndex')->name('admin.users.role');

            // 新增角色
            Route::get('role/add', 'RoleController@getAdd')->name('admin.users.role.add');

            // 保存新增角色
            Route::post('role/postAdd', 'RoleController@postAdd')->name('admin.users.role.postAdd');

            // 编辑角色
            Route::get('role/{id}/edit', 'RoleController@getEdit')->name('admin.users.role.edit');

            // 保存编辑角色
            Route::post('role/{id}/edit', 'RoleController@postEdit')
                ->name('admin.users.role.postEdit');

            // 角色授权
            Route::get('role/{id}/authorize', 'RoleController@getAuthorize')
                ->name('admin.users.role.authorize');

            // 删除角色
            Route::get('role/{id}/delete', 'RoleController@getDelete')
                ->name('admin.users.role.delete');

            // 保存角色授权
            Route::post('role/{id}/authorize', 'RoleController@postAuthorize')
                ->name('admin.users.role.postAuthorize');
        });

    });

});