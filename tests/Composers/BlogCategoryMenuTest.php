<?php namespace Bozboz\Blog\Tests\Composers;

use URL;
use TestCase;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Database\Seeds\BlogCategorySeeder;
use Bozboz\Blog\Database\Seeds\BlogCategoryAndPostSeeder;

class BlogCategoryMenuTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$seeder = new BlogCategoryAndPostSeeder();
		$seeder->run();
	}

	public function test_menu_has_correct_categories()
	{
		$response = $this->call('GET', URL::route('blog.index'));
		$blogCategories = BlogCategory::all();
		$unexpectedBlogCategoryIds = [
			BlogCategorySeeder::INACTIVE_ID,
			BlogCategoryAndPostSeeder::NO_RELATED_POSTS_ID
		];
		$error = false;
		$i = 0;
		while ($i < count($blogCategories) && !$error) {
			$blogCategory = $blogCategories[$i];
			if (strpos($response->getContent(), $blogCategory->name) === false) {
				if (!in_array($blogCategory->id, $unexpectedBlogCategoryIds)) {
					$error = true; //Not in the DOM but should be
				}
			} else {
				if (in_array($blogCategory->id, $unexpectedBlogCategoryIds)) {
					$error = true; //In the DOM but shouldn't be
				}
			}
			$i++;
		}

		$this->assertFalse($error);
	}
}
