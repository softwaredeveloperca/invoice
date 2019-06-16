<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// customer name, their address, invoice date,  invoice number, due date and a brief note
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('invoice_num')->default('');	
			$table->string('first_name', 255)->default('');
			$table->string('last_name', 255)->default('');
			$table->string('address', 255)->default('');
			$table->string('address2', 255)->default('');
			$table->string('city', 255)->default('');
			$table->string('state', 255)->default('CA');
			$table->string('country', 255)->default('US');
			$table->string('zip_code', 10)->default('');
			$table->date('date_due');
			$table->date('date_issued');
			$table->text('note');
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
        Schema::dropIfExists('invoices');
    }
}
