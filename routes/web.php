<?php

use App\Blog;

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

// Route::get('/', function () {
//     return view('welcome');
// });app()->getLocale(),
Route::group([
  'prefix' => '{locale}',
  'where' => ['locale' => '[a-zA-Z]{2}'],
  'middleware' => 'setlocale'], function () {
      Route::group(['middleware' => ['auth']], function () {
          Route::get('/user', 'UserController@user')->name('user');
          Route::name('blog_path')->get('/blog/{blog}', 'BlogController@show');
      });
      Route::name('blogs_path')->get('/', 'BlogController@index');
      Route::name('all-views_blog_path')->get('/all-views', 'BlogController@all_views');
      Auth::routes();
      
      Route::get('/home', 'HomeController@index')->name('home');
      Route::get('/logout', function () {
          Auth::logout();
          return redirect('/');
      });
  });

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'UserController@admin')->name('admin');
    Route::name('create_blog_path')->get('/blog/create', 'BlogController@create');
    Route::name('store_blog_path')->post('/blog', 'BlogController@store');
    Route::name('edit_blog_path')->get('/blog/{blog}/edit', 'BlogController@edit');
    Route::name('update_blog_path')->put('/blog/{blog}', 'BlogController@update');
    Route::name('delete_blog_path')->delete('/blog/{blog}', 'BlogController@destroy');
});

Route::name('redirect')->get('/{provider}', 'Auth\LoginController@redirectToProvider');
Route::name('callback')->get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::name('comment_add')->post('/comment/store', 'CommentController@store');
Route::name('reply_add')->post('/reply/store', 'CommentController@replyStore');
Route::get('/', function () {
    return redirect(app()->getLocale());
});
