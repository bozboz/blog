<?php namespace Bozboz\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
	public function run()
	{
		BlogCategory::truncate();
		$blogCategoriesData = [
			['name' => 'Blog Category #1', 'status' => 1],
			['name' => 'Blog Category #2', 'status' => 1]
		];

		foreach ($blogCategoriesData as $blogCategoryData) {
			BlogCategory::create($blogCategoryData);
		}
	}
}
