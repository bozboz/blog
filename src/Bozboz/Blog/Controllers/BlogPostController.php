<?php namespace Bozboz\Blog\Controllers;

use View;
use Config;
use Controller;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;
use Illuminate\Support\Facades\Request;

class BlogPostController extends Controller
{
	public function getIndex()
	{
		$blogCount = Config::get('blog::blog_count_on_index');

		$blogPosts = BlogPost::active()->orderBy('post_date', 'DESC')->simplePaginate($blogCount);

		if (Request::ajax()) {
			return View::make('blog::post.ajax', ['blogPosts' => $blogPosts]);
		}

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
					->active()
					->firstOrFail();

		return View::make('blog::post.detail', [
			'blogPost' => $blogPost
		]);
	}

	public function getArchive()
	{
		$blogCount = Config::get('blog::blog_count_on_index');

		$blogPosts = BlogPost::active()->orderBy('post_date', 'DESC')->simplePaginate($blogCount);

		return View::make('blog::post.archive')->with('blogPosts', $blogPosts);
	}
}
