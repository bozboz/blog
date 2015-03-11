<?php namespace Bozboz\Blog\Models;

use Bozboz\Admin\Models\Base;
use Bozboz\Blog\Validators\BlogPostValidator;
use DateTime;
use Bozboz\MediaLibrary\Models\MediableTrait;

class BlogPost extends Base
{
	use MediableTrait;

	protected $table = 'blog_posts';

	protected $fillable = ['title', 'short_description', 'content', 'slug', 'blog_status_id', 'post_date', 'youtube_url'];

	protected $dates = ['post_date'];

	public function getValidator()
	{
		return new BlogPostValidator();
	}

	public function status()
	{
		return $this->belongsTo('Bozboz\Blog\Models\BlogStatus', 'blog_status_id');
	}

	public function categories()
	{
		return $this->belongsToMany(
			'Bozboz\Blog\Models\BlogCategory',
			'blog_posts_mm_blog_categories'
		);
	}

	public function scopeActive($query)
	{
		$now = new DateTime;

		$query
			->where('blog_status_id', BlogStatus::ACTIVE)
			->where('post_date', '<=', $now);
	}
	
	/**
	 * Set created_at value and give a default value for post_date
	 * if not already set.
	 * @param DateTime obj $value created_at value
	 */
	public function setCreatedAt($value)
	{
		parent::setCreatedAt($value);
		$this->post_date = $this->post_date ?: $value;
	}
}
