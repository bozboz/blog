<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugsToPostsAndCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach (['blog_posts', 'blog_categories'] as $tableName) {
			Schema::table($tableName, function($table)
			{
				$table->string('slug', 64);
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach (['blog_posts', 'blog_categories'] as $tableName) {
			Schema::table($tableName, function($table)
			{
				$table->dropColumn('slug');
			});
		}
	}

}
