<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(Blueprint $table)
        {
            $table->increments('id');
			$table->string('name');
			$table->bigInteger('user_id')->unsigned()->index();
			$table->string('status');
			$table->integer('category_id')->unsigned()->index();
			$table->integer('country_id')->unsigned();
			$table->decimal('budget');
			$table->text('description');

            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }

}
