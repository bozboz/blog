<?php

Route::group(['namespace' => 'Bozboz\Blog\Controllers'], function()
{
	Route::resource('admin/blog/posts', 'BlogPostAdminController');
	Route::resource('admin/blog/categories', 'BlogCategoryAdminController');

	Route::group(['prefix' => Config::get('blog::url_prefix')], function()
	{
		Route::get('/', [
			'as' => 'blog.index',
			'uses' => 'BlogPostController@getIndex'
		]);
		Route::get('archive', [
			'as' => 'blog.archive',
			'uses' => 'BlogPostController@getArchive'
		]);
		Route::get('{slug}', [
			'as' => 'blog.detail',
			'uses' => 'BlogPostController@getDetail'
		]);
		Route::get('category/{slug}', [
			'as' => 'blog-category.listing',
			'uses' => 'BlogCategoryController@getBlogListing'
		]);
	});

});
