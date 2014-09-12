<?php namespace Bozboz\Blog\Decorators;

use Bozboz\Blog\Models\BlogPost;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\HTMLEditorField;
use Bozboz\Admin\Decorators\ModelAdminDecorator;

class BlogPostAdminDecorator extends ModelAdminDecorator
{
	public function __construct(BlogPost $blogPost)
	{
		parent::__construct($blogPost);
	}

	public function getColumns($instance)
	{
		return [
			'Title' => $this->getLabel($instance),
			'Description' => $instance->getAttribute('short_description'),
			'Status' => $instance->getAttribute('status') ? 'Active' : 'Inactive'
		];
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('title');
	}

	public function getFields()
	{
		return [
			new TextField(['name' => 'title']),
			new TextField(['name' => 'short_description']),
			new HTMLEditorField(['name' => 'content']),
			new SelectField([
				'name' => 'status',
				'options' => [
					'' => 'Select',
					'1' => 'Active',
					'2' => 'Inactive'
				]
			])
		];
	}

	public function getListingModels()
	{
		return $this->model->orderBy('id')->get();
	}
}
