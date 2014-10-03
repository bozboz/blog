<?php namespace Bozboz\Blog\Database\Seeds;

use DB;
use Config;
use Illuminate\Database\Seeder;
use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;

/**
 * Link together BlogPosts and BlogCategories
 */
class BlogCategoryAndPostSeeder extends Seeder
{
	public function run()
	{
		DB::statement('TRUNCATE blog_posts_mm_blog_categories');

		$categorySeeder = new BlogCategorySeeder();
		$postSeeder = new BlogPostSeeder();

		$categorySeeder->run();
		$postSeeder->run();

		foreach (BlogCategory::all() as $blogCategory) {
			if ($blogCategory->name !== 'Blog Category #3 - No related BlogPosts') {
				$blogCount = $blogCategory->id * 2;
				foreach (BlogPost::take($blogCount)->get() as $blogPost) {
					$blogPost->categories()->attach($blogCategory->id);
				}
			}
		}
	}
}
