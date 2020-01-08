<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function () use ($router) {

    $router->addRoute(['GET', 'POST'], '/login', 'AuthController@login'); // 登录
    $router->addRoute(['GET', 'POST'], '/index', 'IndexController@index');
    $router->get('/welcome', 'WelcomeController@index');
    $router->addRoute(['GET', 'POST'], '/siteSetting', 'SiteSettingController@set'); // 网站设置
    $router->post('/upload', 'UploadController@file'); // 文件上传

    // 文章分类
    $router->addRoute(['GET', 'POST'], '/category/add', 'CategoryController@add'); // 添加文章分类
    $router->addRoute(['GET', 'POST'], '/category/addChild/{id:[1-9]+}', 'CategoryController@addChild'); // 添加文章子分类
    $router->addRoute(['GET', 'POST'],'/category/edit/{id:[1-9]+}', 'CategoryController@edit'); // 编辑文章分类
    $router->get('/category/list', 'CategoryController@lists'); // 文章分类列表
    $router->post('/category/del', 'CategoryController@del'); // 删除文章分类
    $router->post('/category/status/{id:[1-9]+}', 'CategoryController@status'); // 更改状态status


    $router->get('/message/list', 'MessageController@lists'); // 在线留言


    $router->get('/article/list', 'ArticleController@lists'); // 文章列表
    $router->addRoute(['GET', 'POST'],'/article/add', 'ArticleController@add'); // 添加文章
    $router->addRoute(['GET', 'POST'],'/article/edit/{id:[1-9]+}', 'ArticleController@edit'); // 编辑文章
    $router->post('/article/del', 'ArticleController@del'); // 删除文章
    $router->post('/article/status/{id:[1-9]+}', 'ArticleController@status'); // 发布状态


    $router->get('/singlePage/list', 'SinglePageController@lists'); // 单页列表
    $router->addRoute(['GET', 'POST'],'/singlePage/add', 'SinglePageController@add'); // 添加单页
    $router->addRoute(['GET', 'POST'],'/singlePage/edit/{id:[1-9]+}', 'SinglePageController@edit'); // 编辑单页
    $router->post('/singlePage/del', 'SinglePageController@del'); // 删除单页

    $router->get('/friendLink/list', 'FriendLinkController@lists'); // 友情链接列表
    $router->addRoute(['GET', 'POST'],'/friendLink/add', 'FriendLinkController@add'); // 添加友情链接
    $router->addRoute(['GET', 'POST'],'/friendLink/edit/{id:[1-9]+}', 'FriendLinkController@edit'); // 编辑友情链接
    $router->post('/friendLink/del', 'FriendLinkController@del'); // 删除友情链接
    $router->post('/friendLink/status/{id:[1-9]+}', 'FriendLinkController@status'); // 发布状态

});

