<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_line_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('invoice_id');
			$table->enum('payment_type', ['Cash', 'Cheque', 'Credit'])->default('Cash');
			$table->float('amount', 8, 2)->default(0.00);
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
        Schema::dropIfExists('payment_line_items');
    }
}
