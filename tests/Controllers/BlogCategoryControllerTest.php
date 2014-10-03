<?php namespace Bozboz\Blog\Tests\Controllers;

use URL;
use Config;
use TestCase;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Database\Seeds\BlogCategoryAndPostSeeder;

class BlogCategoryControllerTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$seeder = new BlogCategoryAndPostSeeder();
		$seeder->run();
	}

	public function test_category_listing()
	{
		Config::set('blog::sticky_posts_enabled', false);
		$blogCategoryId = 2;
		$blogCategory = BlogCategory::find($blogCategoryId);
		$response = $this->call('GET', URL::route('blog-category.listing', ['slug' => $blogCategory->slug]));
		$blogPosts = BlogPost::take($blogCategoryId)->get();

		$error = false;
		$i = 0;
		while ($i < $blogPosts->count() && !$error) {
			if (strpos($response->getContent(), $blogPosts->get($i)->title) === false) {
				$error = true;
			}
			$i++;
		}

		if (!$error) {
			$blogPosts = BlogPost::take(BlogPost::all()->count())->skip(2)->get();
			$i = 0;
			while ($i < $blogPosts->count() && !$error) {
				if (strpos($response->getContent(), $blogPosts[$i]->title) !== false) {
					$error = true;
				}
				$i++;
			}
		}

		$this->assertFalse($error);
	}

	public function test_category_listing_with_sticky_post()
	{
		Config::set('blog::sticky_posts_enabled', true);

		//Attach sticky BlogPost
		$blogCategoryId = 1;
		$blogCategory = BlogCategory::find($blogCategoryId);
		$stickyBlogPost = BlogPost::all()->last();
		$blogCategory->sticky_post_id = $stickyBlogPost->id;
		$blogCategory->save();

		$response = $this->call('GET', URL::route('blog-category.listing', ['slug' => $blogCategory->slug]));

		$stickyPostPosition = strpos($response->getContent(), $stickyBlogPost->title);
		$firstCategoryBlogPostPosition = strpos($response->getContent(), $blogCategory->blogPosts()->first()->title);

		$this->assertTrue($stickyPostPosition !== false && $stickyPostPosition < $firstCategoryBlogPostPosition);
	}
}
