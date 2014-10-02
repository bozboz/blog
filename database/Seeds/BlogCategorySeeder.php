<?php namespace Bozboz\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
	public function run()
	{
		BlogCategory::truncate();
		$blogCategoriesData = [
			['name' => 'Blog Category #1', 'status' => 1, 'slug' => 'category-1'],
			['name' => 'Blog Category #2', 'status' => 1, 'slug' => 'category-2'],
			['name' => 'Blog Category #3 - No related BlogPosts', 'status' => 1, 'slug' => 'category-3'],
			['name' => 'Blog Category #4 - Inactive', 'status' => 0, 'slug' => 'category-4']
		];

		foreach ($blogCategoriesData as $blogCategoryData) {
			BlogCategory::create($blogCategoryData);
		}
	}
}
