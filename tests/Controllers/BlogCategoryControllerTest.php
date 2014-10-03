<?php namespace Bozboz\Blog\Tests\Controllers;

use URL;
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
		$blogCategoryId = 1;
		$blogCategory = BlogCategory::find($blogCategoryId);
		$response = $this->call('GET', URL::route('blog-category.listing', ['slug' => $blogCategory->slug]));
		$blogPosts = BlogPost::take($blogCategoryId * 2)->get();

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
}
