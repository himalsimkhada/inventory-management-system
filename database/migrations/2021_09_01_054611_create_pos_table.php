<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pos', function (Blueprint $table) {
            $table->id();

            $table->string('refrence_number');

            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('ware_houses');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('item');
            $table->string('tax')->nullable();
            $table->string('discount')->nullable();
            $table->string('total');
            $table->string('recieved_amount');
            $table->string('change');
            $table->string('paidBy');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pos');
    }
}
