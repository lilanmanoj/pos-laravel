<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method', 10)->nullable(false)->default('cash');
            $table->double('sub_total')->nullable(false)->default(0);
            $table->double('discount')->nullable(false)->default(0);
            $table->double('total')->nullable(false)->default(0);
            $table->double('paid')->nullable(false)->default(0);
            $table->double('balance')->nullable(false)->default(0);
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
        Schema::dropIfExists('sales');
    }
}
