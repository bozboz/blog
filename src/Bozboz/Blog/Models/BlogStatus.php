<?php namespace Bozboz\Blog\Models;

use Eloquent;

class BlogStatus extends Eloquent
{
	const INACTIVE = 1;
	const ACTIVE = 2;

	protected $table = 'blog_statuses';

	protected $fillable = ['name'];

	public function blogPosts()
	{
		return $this->hasMany('Bozboz\Blog\Models\BlogPost');
	}
}
