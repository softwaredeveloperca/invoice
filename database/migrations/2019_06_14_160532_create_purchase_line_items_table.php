<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_line_items', function (Blueprint $table) {
            $table->integer('product_id');
			$table->integer('invoice_id');
			$table->float('cost', 8, 2)->default(0.00);
			$table->integer('qty')->default(0);
			$table->float('tax_rate', 2, 2)->default(0.00);
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
        Schema::dropIfExists('purchase_line_items');
    }
}
