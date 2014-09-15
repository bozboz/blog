<?php

use Bozboz\Blog\Models\BlogStatus;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlogStatuses extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$blogStatusesData = [
			['name' => 'Inactive'],
			['name' => 'Active']
		];

		foreach ($blogStatusesData as $blogStatusData) {
			BlogStatus::create($blogStatusData);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		BlogStatus::truncate();
	}

}
