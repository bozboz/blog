<?php namespace Bozboz\Blog\Tests\Models;

use TestCase;
use Bozboz\Blog\Database\Seeds\BlogCategorySeeder;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategoryTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$seeder = new BlogCategorySeeder();
		$seeder->run();
	}

	public function testToArray()
	{
		$expectedOutput = [
			1 => 'Blog Category #1',
			2 => 'Blog Category #2',
			3 => 'Blog Category #3 - No related BlogPosts',
			4 => 'Blog Category #4 - Inactive'
		];

		$blogCategory = new BlogCategory();
		$actualOutput = $blogCategory->toArray();

		$this->assertEquals($expectedOutput, $actualOutput);
	}
}
