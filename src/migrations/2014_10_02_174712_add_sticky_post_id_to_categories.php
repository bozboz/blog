<?php

use Bozboz\Blog\Models\BlogCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStickyPostIdToCategories extends Migration {

	private $tableName = 'blog_categories';

	private $columnName = 'sticky_post_id';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table($this->tableName, function($table)
		{
			$table->integer($this->columnName);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table($this->tableName, function($table)
		{
			$table->dropColumn($this->columnName);
		});
	}

}
