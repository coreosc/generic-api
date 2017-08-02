<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->uuid('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->string('first_name', 32);
			$table->string('last_name', 32);
			$table->string('company_name', 64);
			$table->string('address');
			$table->string('city', 64);
			$table->uuid('country_id')->nullable();
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('cascade');

			$table->string('postcode', 12);
			$table->string('phone', 32)->nullable();
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
		Schema::dropIfExists('delivery_addresses');
	}

}
