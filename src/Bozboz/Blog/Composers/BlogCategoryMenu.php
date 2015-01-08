<?php namespace Bozboz\Blog\Composers;

use DB;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Models\BlogCategory;

class BlogCategoryMenu
{
	public function compose($view)
	{
		$view->with('categories', $this->getCategories());
	}

	/**
	 * Get a collection of BlogCategory models that
	 * are active and are related to active BlogPosts.
	 *
	 * @return array
	 */
	private function getCategories()
	{
		$blogCategories = BlogCategory::where('status', '=', 1)->whereHas('blogPosts', function($query)
		{
			$query->active();
		})->get();

		return $blogCategories;
	}
}
