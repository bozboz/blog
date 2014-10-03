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
		$viewParams = [];
		$category = BlogCategory::where('status', '=', 1)->where('slug', '=', $slug)->firstOrFail();
		$viewParams['category'] = $category;
		if (Config::get('blog::sticky_posts_enabled')) {
			$viewParams['stickyBlogPost'] = $category->stickyBlogPost()->where('blog_status_id', '=', BlogStatus::ACTIVE)->first();
		}

		return View::make('blog::category.blog-listing', $viewParams);
	}
}
