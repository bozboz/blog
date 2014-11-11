<?php

Route::group(['namespace' => 'Bozboz\Blog\Controllers'], function()
{
	Route::resource('admin/blog/posts', 'BlogPostAdminController');
	Route::resource('admin/blog/categories', 'BlogCategoryAdminController');

	Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogPostController@getIndex']);
	Route::get('blog/archive', ['as' => 'blog.archive', 'uses' => 'BlogPostController@getArchive']);
	Route::get('blog/{slug}', ['as' => 'blog.detail', 'uses' => 'BlogPostController@getDetail']);
	Route::get('blog/category/{slug}', [
		'as' => 'blog-category.listing',
		'uses' => 'BlogCategoryController@getBlogListing'
	]);
});
