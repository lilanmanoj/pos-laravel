<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_no')->nullable(false);
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->string('barcode', 40)->nullable();
            $table->double('quantity')->nullable(false)->default(0);
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->double('unit_price')->nullable(false)->default(0);
            $table->double('total')->nullable(false)->default(0);
            $table->unsignedBigInteger('created_by')->nullable(false);
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
        Schema::dropIfExists('product_sale');
    }
}
