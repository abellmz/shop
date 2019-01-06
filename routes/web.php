<?php

Route::get('/', 'Home\IndexController@index');
//前台
Route::group(['prefix' => 'home', 'namespace' => 'Home', 'as' => 'home.'], function () {
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('list/{list}', 'ListController@index')->name('list');
    Route::get('content/{content}', 'ContentController@index')->name('content');
    Route::post('spec_to_get_total', 'ContentController@specGetTotal')->name('spec_to_get_total');
//用户管理
    Route::resource('user','UserController');
    //登录
    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/login', 'UserController@loginForm')->name('login');
//注册
    Route::get('/register', 'UserController@register')->name('register');
    Route::post('/register', 'UserController@store')->name('register');
//密码重置,注销
    Route::get('/password_reset', 'UserController@passwordReset')->name('password_reset');
    Route::post('/password_reset', 'UserController@passwordResetForm')->name('password_reset');
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/edit', 'UserController@edit')->name('edit');
//搜索
    Route::get('search','IndexController@search')->name('search');

    //    购物车
    Route::resource('cart', 'CartController');
//    订单管理页面
    Route::resource('order', 'OrderController');
//    支付模板页面
    Route::get('pay', 'PayController@index')->name('pay');
//    个人中心首页
    Route::get('personal_center', 'PersonalCenterController@index')->name('personal_center');
//    地址管理
    Route::resource('address', 'AddressController');
//    微信支付回调通知
    Route::any('notify','PayController@notify')->name('notify');
//   检测订单是否支付（支付状态）
    Route::post('check_order_status','PayController@checkOrderStatus')->name('check_order_status');
//回调地址
    Route::get('qq_back','IndexController@qqBack')->name('qq_back');
    Route::get('qq_login','IndexController@qqLogin')->name('qq_login');
});
//后台不需要拦截
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
//    登录
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');

});
//后台需要拦截的
Route::group(['middleware' => ['admin.auth'], 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
//    退出登录
    Route::get('/logout', 'LoginController@logout')->name('logout');
//    后台欢迎
    Route::get('/', 'IndexController@index')->name('index');
//    栏目管理
    Route::resource('category', 'CategoryController');
//    商品管理
    Route::resource('good', 'GoodController');
//    配置项管理
    Route::resource('config', 'ConfigController');

//    管理员管理
    Route::resource('admin','AdminController');
    Route::get('admin_set_role_create/{admin}','AdminController@adminSetRoleCreate')->name('admin_set_role_create');
//角色管理
    Route::resource('role','RoleController');
// 权限管理
    Route::get('permission','PermissionController@index')->name('permission');
//    清除权限缓存
    Route::get('forget_permission_cache','PermissionController@forgetPermissionCache')->name('forget_permission_cache');

});
//工具类
Route::group(['prefix' => 'util', 'namespace' => 'Util', 'as' => 'util.'], function () {
//    上传
    Route::any('/upload', 'UploadController@upload')->name('upload');
//    注册验证码
    Route::any('/code/send', 'CodeController@send')->name('code.send');
});
