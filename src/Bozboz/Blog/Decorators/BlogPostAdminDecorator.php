<?php namespace Bozboz\Blog\Decorators;

use Bozboz\Blog\Models\BlogPost;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Models\BlogStatus;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\HTMLEditorField;
use Bozboz\Admin\Fields\CheckboxesField;
use Bozboz\Admin\Decorators\ModelAdminDecorator;

class BlogPostAdminDecorator extends ModelAdminDecorator
{
	public function __construct(BlogPost $blogPostFactory)
	{
		parent::__construct($blogPostFactory);
	}

	public function getColumns($instance)
	{
		return [
			'Title' => $this->getLabel($instance),
			'Description' => $instance->getAttribute('short_description'),
			'Status' => $instance->blog_status_id === BlogStatus::ACTIVE ? 'Active' : 'Inactive'
		];
	}

	public function getSyncRelations()
	{
		return ['categories'];
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
			new TextField(['name' => 'slug']),
			new CheckboxesField([
				'name' => 'categories_relationship',
				'label' => 'Categories',
				'options' => \Bozboz\Blog\Models\BlogCategory::all(),
			]),
			new SelectField([
				'name' => 'blog_status_id',
				'label' => 'Status',
				'options' => array_replace(
					['' => 'Select'],
					BlogStatus::lists('name', 'id')	
				)
			])
		];
	}

	public function getListingModels()
	{
		return $this->model->orderBy('id')->get();
	}
}
