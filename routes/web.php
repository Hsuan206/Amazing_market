<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
	return view('template.index');
});

// 點 navbar 的 blog 顯示文章列表
Route::get('blog', 'BlogController@getArticle')->name('blog');
// 新增文章
Route::post('blog', 'BlogController@storeArticle')->name('article-store');
// 點查看更多顯示的文章
Route::get('blog-single/{article}', 'BlogController@showArticle')->name('blog-single');
// 點 nav 右上角的人名進入到個人文章列表
Route::get('blog-personal', 'BlogController@userArticlelist')->name('blog-personal');
// 更新文章
Route::patch('blog-personal', 'BlogController@updateArticle');
// 刪除文章
Route::delete('blog-personal', 'BlogController@deleteArticle');

//新增留言
Route::post('blog-single/{post_id}','CommentsController@store')->name('comment-store');


// 收藏區
Route::get('/collect', 'CollectionController@index');
// 新增收藏
Route::post('/collect/create', 'CollectionController@create');
// 刪除收藏
Route::post('/collect/delete', 'CollectionController@delete');
// 獲得特定使用者的收藏
Route::get('/collect/getCollectionByUser', 'CollectionController@getCollectionByUser');
// 獲得OpenData
Route::get('/collect/getOpenData','CollectionController@getOpenData');


// 幻燈片區
// 顯示幻燈片管理頁面
Route::get('/carousel','CarouselController@manageCarousel');
// 新增幻燈片
Route::post('/carousel/create','CarouselController@createCarousel');

Auth::routes();

//使用者登入
Route::post('/loginnow','Auth\LoginController@login');
//使用者註冊
Route::post('/auth/register','Auth\RegisterController@register');
//顯示使用者登入頁面
Route::get('/auth','MyLoginController@auth');
//使用者註冊頁面
Route::get('/auth/register','MyLoginController@register');

