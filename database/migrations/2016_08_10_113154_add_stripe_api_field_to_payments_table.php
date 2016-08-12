<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStripeApiFieldToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('payments', function(Blueprint $table) {
		    $table->string('stripe_id')->after('is_paid')->nullable();

	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('payments', function(Blueprint $table) {
		    $table->dropColumn('stripe_id');

	    });
    }
}
