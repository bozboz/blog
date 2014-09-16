<?php namespace Bozboz\Blog\Database\Seeds;

use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
	public function run()
	{
		BlogCategory::truncate();
		$blogCategoriesData = [
			['name' => 'Blog Category #1', 'blog_status_id' => BlogStatus::ACTIVE],
			['name' => 'Blog Category #2', 'blog_status_id' => BlogStatus::ACTIVE]
		];

		foreach ($blogCategoriesData as $blogCategoryData) {
			BlogCategory::create($blogCategoryData);
		}
	}
}