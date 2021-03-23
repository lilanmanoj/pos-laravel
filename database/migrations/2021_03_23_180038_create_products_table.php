<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable(false);
            $table->string('name', 100)->nullable(false);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('product_type_id')->nullable(false);
            $table->boolean('is_measurable')->nullable(false)->default(0);
            $table->string('barcode_prefix')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable(false);
            $table->double('unit_price')->nullable(false)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}
