<?php namespace Bozboz\Blog\Decorators;

use Config;
use Bozboz\Admin\Fields\TextField;
use Bozboz\Admin\Fields\SelectField;
use Bozboz\Admin\Fields\CheckboxField;
use Bozboz\Blog\Models\BlogCategory;
use Bozboz\Blog\Models\BlogPost;
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
		$fields = [
			new TextField(['name' => 'name']),
			new TextField(['name' => 'slug']),
		];

		if (Config::get('blog::sticky_posts_enabled')) {
			$fields[] = new SelectField([
				'name' => 'sticky_post_id',
				'label' => 'Sticky Post',
				'options' => array_replace(
					['' => 'Select'],
					BlogPost::lists('title', 'id')
				)
			]);
		}

		$fields[] = new CheckboxField(['name' => 'status']);

		return $fields;
	}
}
