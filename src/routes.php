<?php

Route::group(['namespace' => 'Bozboz\Blog\Controllers'], function()
{
	Route::resource('admin/blog-posts', 'BlogPostAdminController');
	Route::resource('admin/blog-categories', 'BlogCategoryAdminController');

	Route::get('blog', ['as' => 'blogIndex', 'uses' => 'BlogPostController@getIndex']);
	Route::get('blog/{slug}', ['as' => 'blogDetail', 'uses' => 'BlogPostController@getDetail']);
});
