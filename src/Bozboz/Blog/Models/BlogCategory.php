<?php namespace Bozboz\Blog\Models;

use Config;
use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Blog\Validators\BlogCategoryValidator;

class BlogCategory extends Base
{
	protected $table = 'blog_categories';

	protected $fillable = ['name', 'slug', 'status', 'sticky_post_id'];

	public function getValidator()
	{
		return new BlogCategoryValidator();
	}

	public function blogPosts()
	{
		return $this->belongsToMany(
			'Bozboz\Blog\Models\BlogPost',
			'blog_posts_mm_blog_categories'
		);
	}

	public function stickyBlogPost()
	{
		return $this->belongsTo('Bozboz\Blog\Models\BlogPost', 'sticky_post_id');
	}

	/**
	 * Get all BlogPosts tagged to this BlogCategory.
	 * Factors in sticky post functionality if it is enabled.
	 * If the sticky post is already related to the BlogCategory,
	 * it will simply be the first element in the Collection.
	 */
	public function getBlogPosts()
	{
		$blogPostsBuilder = $this->blogPosts();
		$blogPostsBuilder = $blogPostsBuilder->active();
		$blogPostsBuilder->orderBy('post_date', 'DESC');
		if (Config::get('blog::sticky_posts_enabled')) {
			$stickyBlogPost = $this->stickyBlogPost()->active()->first();
			if (!empty($stickyBlogPost)) {
				$blogPosts = $blogPostsBuilder->where($stickyBlogPost->getTable() . '.id', '!=', $stickyBlogPost->id)->get();
				$blogPosts->prepend($stickyBlogPost);
			} else {
				$blogPosts = $blogPostsBuilder->get();
			}
		} else {
			$blogPosts = $blogPostsBuilder->get();
		}

		return $blogPosts;
	}
}
