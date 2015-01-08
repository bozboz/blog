<?php namespace Bozboz\Blog\Tests\Controllers;

use URL;
use Config;
use TestCase;
use Bozboz\Blog\Database\Seeds\BlogPostSeeder;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Models\BlogCategory;

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
		$response = $this->call('GET', URL::route('blog.index'));
		$blogPosts = BlogPost::active()->take(Config::get('blog::blog_count_on_index'));

		foreach ($blogPosts as $blogPost) {
			$this->assertContains($blogPost->title, $response->getContent());
		}
	}

	public function test_index_with_no_blog_posts()
	{
		BlogPost::truncate();
		$response = $this->call('GET', URL::route('blog.index'));

		$this->assertContains('no blog posts', strtolower($response->getContent()));
	}

	public function test_blog_detail()
	{
		$blogPost = BlogPost::active()->first();
		$response = $this->call('GET', URL::route('blog.detail', ['slug' => $blogPost->slug]));

		$this->assertContains($blogPost->content, $response->getContent());
	}
}
