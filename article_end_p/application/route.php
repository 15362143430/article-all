<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// common
Route::get('database', 'api/common/database_count');

// user
Route::get('users/:pageNum/:pageSize/[:name]', 'api/user/users_list');
Route::get('userPosition/:pageNum/:pageSize', 'api/user/user_position');
Route::delete('user/:id', 'api/user/user_delete');
Route::put('user', 'api/user/user_edit');
Route::post('login', 'api/user/login');
Route::post('register', 'api/user/register');
Route::get('user/:id', 'api/user/user_detail');
// article
Route::get('articles/:pageNum/:pageSize/[:type]/[:title]', 'api/article/articles_list');
Route::get('article/:id', 'api/article/article_detail');
Route::get('articlemd/:id', 'api/article/article_content');
Route::post('article', 'api/article/article_add');
Route::put('article', 'api/article/article_edit');
Route::get('articleTypeSelect', 'api/article/articles_select');
Route::get('articlestype', 'api/article/articles_type');
Route::delete('article/:id', 'api/article/article_delete');

// video
Route::get('videos', 'api/video/videos_list');
Route::get('videosms/:pageNum/:pageSize', 'api/video/videos_list_ms');
Route::get('videostype', 'api/video/videos_type');
Route::get('video/:id', 'api/video/video_detail');
Route::get('videosbytype', 'api/video/videos_list_type');
Route::delete('video/:id', 'api/video/video_delete');
Route::get('videoTypeSelect', 'api/video/videos_select');
Route::put('video', 'api/video/video_edit');

// menu
Route::get('menus/[:level]', 'api/menu/menus_list');

// power
Route::get('rights/:pageNum/:pageSize', 'api/power/rights_list');
Route::get('roles', 'api/power/roles_list');
Route::put('role', 'api/power/role_edit');
Route::get('role/:id', 'api/power/role_detail');
Route::get('roleTypeSelect', 'api/power/roles_select');
Route::put('right', 'api/power/right_edit');
Route::delete('right/:role_id/:operation_id', 'api/power/right_delete');
Route::post('role', 'api/power/role_add');
// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
