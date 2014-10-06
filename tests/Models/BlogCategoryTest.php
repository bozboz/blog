<?php namespace Bozboz\Blog\Tests\Models;

use DB;
use Config;
use TestCase;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Database\Seeds\BlogPostSeeder;
use Bozboz\Blog\Database\Seeds\BlogCategorySeeder;

class BlogCategoryTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$postSeeder = new BlogPostSeeder();
		$categorySeeder = new BlogCategorySeeder();

		$postSeeder->run();
		$categorySeeder->run();

		DB::statement('TRUNCATE blog_posts_mm_blog_categories');
	}

	public function test_get_blog_posts_sticky_posts_disable()
	{
		Config::set('blog::sticky_posts_enabled', false);

		$blogPosts = BlogPost::all()->take(5);
		$blogCategory = BlogCategory::all()->first();
		foreach ($blogPosts as $blogPost) {
			$blogCategory->blogPosts()->attach($blogPost->id);
		}

		$i = 0;
		$error = false;
		$categoryBlogPosts = $blogCategory->getBlogPosts();
		while ($i < $blogPosts->count() && !$error) {
			$j = 0;
			$found = false;
			while ($j < $categoryBlogPosts->count() && !$found) {
				if ($blogPosts->get($i)->id === $categoryBlogPosts->get($j)->id) {
					$found = true;
				}
				$j++;
			}
			if (!$found) {
				$error = true;
			}
			$i++;
		}

		$this->assertFalse($error);
	}

	public function test_get_blog_posts_sticky_posts_enabled()
	{
		Config::set('blog::sticky_posts_enabled', true);

		$blogPosts = BlogPost::all()->take(5);
		$blogCategory = BlogCategory::all()->first();
		foreach ($blogPosts as $blogPost) {
			$blogCategory->blogPosts()->attach($blogPost->id);
		}

		$stickyBlogPost = $blogPosts->last();
		$blogCategory->sticky_post_id = $stickyBlogPost->id;
		$blogCategory->save();

		$categoryBlogPosts = $blogCategory->getBlogPosts();


		$count = 0;
		foreach ($categoryBlogPosts as $categoryBlogPost) {
			if ($categoryBlogPost->id === $stickyBlogPost->id) {
				$count++;
			}
		}

		$this->assertEquals($categoryBlogPosts->get(0)->id, $stickyBlogPost->id);
		$this->assertEquals(1, $count);

	}
}
