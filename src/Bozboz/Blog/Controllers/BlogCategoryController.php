<?php namespace Bozboz\Blog\Controllers;

use View;
use Config;
use Controller;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategoryController extends Controller
{
	public function getBlogListing($slug)
	{
		$category = BlogCategory::where('status', '=', 1)->where('slug', '=', $slug)->firstOrFail();

		return View::make('blog::category.blog-listing', [
			'category' => $category,
			'blogPosts' => $category->getBlogPosts()
		]);
	}
}
