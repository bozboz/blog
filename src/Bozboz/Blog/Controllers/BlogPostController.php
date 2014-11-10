<?php namespace Bozboz\Blog\Controllers;

use View;
use Config;
use Controller;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;

class BlogPostController extends Controller
{
	public function getIndex()
	{
		$blogCount = Config::get('blog::blog_count_on_index');
		$blogPosts = BlogPost::where('blog_status_id', '=', BlogStatus::ACTIVE)->take($blogCount)->get();
		if ($blogPosts->isEmpty()) {
			$response = View::make('blog::post.empty');
		} else {
			$response = View::make('blog::post.index', [
				'blogPosts' => $blogPosts
			]);
		}

		return $response;
	}

	public function getDetail($slug)
	{
		$blogPost = BlogPost::where('slug', '=', $slug)
					->where('blog_status_id', '=', BlogStatus::ACTIVE)
					->firstOrFail();

		return View::make('blog::post.detail', [
			'blogPost' => $blogPost
		]);
	}

	public function getArchive()
	{
		$blogPosts = BlogPost::where('blog_status_id', '=', BlogStatus::ACTIVE)->latest()->simplePaginate(12);

		return View::make('blog::post.archive')->with('blogPosts', $blogPosts);
	}
}
