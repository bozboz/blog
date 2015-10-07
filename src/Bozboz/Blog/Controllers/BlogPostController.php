<?php namespace Bozboz\Blog\Controllers;

use View;
use Config;
use Controller;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogPostController extends Controller
{
	public function getIndex()
	{
		$blogCount = Config::get('blog::blog_count_on_index');

		$blogPosts = BlogPost::active()->orderBy('post_date', 'DESC')->paginate($blogCount);

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
					->first();

		if ( ! $blogPost) throw new NotFoundHttpException;

		return View::make('blog::post.detail', [
			'blogPost' => $blogPost
		]);
	}

	public function getArchive()
	{
		$blogCount = Config::get('blog::blog_count_on_index');

		$blogPosts = BlogPost::active()->orderBy('post_date', 'DESC')->paginate($blogCount);

		return View::make('blog::post.archive')->with('blogPosts', $blogPosts);
	}
}
