<?php namespace Bozboz\Blog\Controllers;

use View;
use Controller;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategoryController extends Controller
{
	public function getBlogListing($slug)
	{
		return View::make('blog::category.blog-listing', [
			'category' => BlogCategory::where('status', '=', 1)->where('slug', '=', $slug)->firstOrFail()
		]);
	}
}
