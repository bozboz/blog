<?php namespace Bozboz\Blog\Validators;

use Bozboz\Admin\Services\Validators\Validator;

class BlogCategoryValidator extends Validator
{
	protected $rules = [
		'name' => 'required|min:3|max:255|unique:blog_categories',
		'slug' => 'required|max:64|unique:blog_categories',
		'status' => 'required'
	];
}
