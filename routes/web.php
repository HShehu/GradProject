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

Route::group([
  'prefix' => '{locale}',
  'where' => ['locale' => '[a-zA-Z]{2}'],
  'middleware' => 'setlocale'], function () {
      Auth::routes();
    
      Route::get('/logout', function () {
          Auth::logout();
          return redirect('/');
      });

      //Users Views With Multilingual Functionality
      Route::name('users.index')->get('/users', 'UserController@index');
      Route::name('users.create')->get('/users/create', 'UserController@create');
      Route::name('users.edit')->get('/users/{user}/edit', 'UserController@edit');
      Route::name('users.show')->get('/users/{user}', 'UserController@show');

      //Roles Views With Multilingual Functionality
      Route::name('roles.index')->get('/roles', 'RoleController@index');
      Route::name('roles.create')->get('/roles/create', 'RoleController@create');
      Route::name('roles.edit')->get('/roles/{role}/edit', 'RoleController@edit');
      Route::name('roles.show')->get('/roles/{role}', 'RoleController@show');

      //Permissions Views With Multilingual Functionality
      Route::name('permissions.index')->get('/permissions', 'PermissionController@index');
      Route::name('permissions.create')->get('/permissions/create', 'PermissionController@create');
      Route::name('permissions.edit')->get('/permissions/{permission}/edit', 'PermissionController@edit');
      Route::name('permissions.show')->get('/permissions/{permission}', 'PermissionController@show');
      
      //Blog Views With Multilingual Functionality
      Route::name('all-views_blog_path')->get('/all-views', 'BlogController@all_views');
      Route::name('blogs.index')->get('/', 'BlogController@index');
      Route::name('blogs.create')->get('/blogs/create', 'BlogController@create');
      Route::name('blogs.edit')->get('/blogs/{blog}/edit', 'BlogController@edit');
      Route::name('blogs.show')->get('/blogs/{blog}', 'BlogController@show');
      
      Route::group(['middleware' => ['permission:Administer users']], function () {
          Route::get('/admin', 'UserController@admin')->name('admin');
          Route::name('blogs.list')->get('/bloglist', 'BlogController@admin');
          Route::name('comments.list')->get('/commentlist', 'CommentController@admin');
      });
  });
    
Route::group(['middleware' => ['permission:Administer roles & permissions']], function () {
    Route::name('roles.update')->put('/roles/{role}', 'RoleController@update');
    Route::name('roles.destroy')->delete('/roles/{role}', 'RoleController@destroy');
    Route::name('roles.store')->post('/roles', 'RoleController@store');

    Route::name('permissions.update')->put('/permissions/{permission}', 'PermissionController@update');
    Route::name('permissions.destroy')->delete('/permissions/{permission}', 'PermissionController@destroy');
    Route::name('permissions.store')->post('/permissions', 'PermissionController@store');
});

Route::group(['middleware' => ['permission:Administer users']], function () {
    Route::name('users.update')->put('/users/{user}', 'UserController@update');
    Route::name('users.destroy')->delete('/users/{user}', 'UserController@destroy');
    Route::name('users.store')->post('/users', 'UserController@store');
});

Route::group(['middleware' => ['permission:edit blog posts']], function () {
    Route::name('blogs.update')->put('/blogs/{blog}', 'BlogController@update');
    Route::name('blogs.destroy')->delete('/blogs/{blog}', 'BlogController@destroy');
    Route::name('blogs.store')->post('/blogs', 'BlogController@store');
});

Route::name('printqr')->get('/printqr', 'QrController@index');
Route::name('comments.destroy')->delete('/comment/{comment}', 'CommentController@destroy');



Route::name('redirect')->get('/{provider}', 'Auth\LoginController@redirectToProvider');
Route::name('callback')->get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::name('comment_add')->post('/comment/store', 'CommentController@store');
Route::name('reply_add')->post('/reply/store', 'CommentController@replyStore');
Route::get('/', function () {
    return redirect(app()->getLocale());
});
