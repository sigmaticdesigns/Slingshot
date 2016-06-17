<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->bigIncrements('id');
			$table->integer('project_id')->unsigned()->index();
			$table->bigInteger('user_id')->unsigned()->index();
			$table->decimal('amount');
			$table->string('method');
			$table->boolean('is_paid')->index()->default(0);
			$table->text('response');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }

}
