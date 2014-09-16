<?php namespace Bozboz\Blog\Decorators;

use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\CheckboxField;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Admin\Decorators\ModelAdminDecorator;

class BlogCategoryAdminDecorator extends ModelAdminDecorator
{
	public function __construct(BlogCategory $categoryFactory)
	{
		parent::__construct($categoryFactory);
	}

	public function getListingModels()
	{
		return $this->model->all();
	}

	public function getColumns($instance)
	{
		return [
			'Name' => $instance->getAttribute('name'),
			'Status' => $instance->getAttribute('status') == 1 ? 'Active' : 'Inactive'
		];
	}

	public function getLabel($instance)
	{
		return $instance->getAttribute('name');
	}

	public function getFields()
	{
		return [
			new TextField(['name' => 'name']),
			new CheckboxField(['name' => 'status'])
		];
	}
}
