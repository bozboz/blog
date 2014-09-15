<?php namespace Bozboz\Blog\Validators;

use Bozboz\Admin\Services\Validators\Validator;

class BlogPostValidator extends Validator
{
	protected $rules = [
		'title' => 'required|max:128',
		'short_description' => 'required|max:255',
		'content' => 'required',
		'blog_status_id' => 'required'
	];
}
