<?php
Route::get('admin/logins','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@dologin');
Route::get('home/logins','Home\LoginController@login');
Route::post('home/dologin','Home\LoginController@dologin');
Route::get('/admin/showper','Admin\RoleController@showper');
Route::get('admin/captcha','Admin\LoginController@captcha');
//后台
Route::group(['middleware'=>'login'], function(){
	//后台的首页
	Route::get('admins','Admin\IndexController@index');
	//修改头像
	Route::get('admin/profile','Admin\LoginController@profile');
	Route::post('admin/upload','Admin\LoginController@upload');
	//修改密码
	Route::get('admin/pass','Admin\LoginController@pass');
	Route::post('admin/dopass','Admin\LoginController@dopass');
	//退出
	Route::get('admin/logout','Admin\LoginController@logout');
	//后台管理员
	Route::resource('/admin/admins','Admin\AdminsController');
	Route::get('/admin/userrole','Admin\AdminsController@user_role');
	Route::post('/admin/douserrole','Admin\AdminsController@do_user_role');
	//后台用户管理
	Route::get('/admin/user/delete','Admin\UserController@delete');
	Route::get('/admin/userinfo/delete','Admin\UserInfoController@delete');
	Route::resource('/admin/user','Admin\UserController');
	Route::resource('/admin/userinfo','Admin\UserInfoController');
	//角色权限管理
	Route::resource('/admin/role','Admin\RoleController');
	Route::resource('/admin/permission','Admin\PermissionController');
	Route::get('/admin/roleper','Admin\RoleController@role_per');
	Route::post('/admin/doroleper','Admin\RoleController@doroleper');
	//友情链接
	Route::resource('admin/link','Admin\LinkController');
	//轮播图
	Route::resource('admin/lunbo','Admin\LunboController');
	//广告
	Route::resource('admin/guanggao','Admin\GuangGaoController');
	//订单
	Route::resource('admin/order','Admin\OrderController');
	//分类管理
	Route::resource('/admin/category','Admin\CategoryController');
	//商品管理
	Route::resource('/admin/goods','Admin\GoodsController');
});

//前台
Route::get('/','Home\IndexController@index');
Route::group(['middleware'=>'ulogin'], function(){
	
});

