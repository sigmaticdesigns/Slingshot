<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeadlineToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
			$table->integer('file_id')->unsigned()->after('budget')->nullable();
			$table->date('deadline')->after('description');
			$table->date('half_deadline')->after('deadline');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function(Blueprint $table) {
			$table->dropColumn('file_id');
			$table->dropColumn('deadline');
			$table->dropColumn('half_deadline');

        });
    }

}
