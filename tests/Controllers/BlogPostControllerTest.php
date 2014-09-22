<?php namespace Bozboz\Blog\Tests\Controllers;

use URL;
use TestCase;
use Bozboz\Blog\Database\Seeds\BlogPostSeeder;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;

class BlogPostControllerTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$seeder = new BlogPostSeeder();
		$seeder->run();
	}

	public function test_index_has_blog_list()
	{
		$response = $this->call('GET', URL::route('blogIndex'));
		$blogPosts = BlogPost::where('blog_status_id', '=', BlogStatus::ACTIVE)->get();

		foreach ($blogPosts as $blogPost) {
			$this->assertContains($blogPost->title, $response->getContent());
		}
	}

	public function test_index_with_no_blog_posts()
	{
		BlogPost::truncate();
		$response = $this->call('GET', URL::route('blogIndex'));

		$this->assertContains('no blog posts', strtolower($response->getContent()));
	}

	public function test_blog_detail()
	{
		$blogPost = BlogPost::where('blog_status_id', '=', BlogStatus::ACTIVE)->first();
		$response = $this->call('GET', URL::route('blogDetail', ['slug' => $blogPost->slug]));

		$this->assertContains($blogPost->content, $response->getContent());
	}
}
