<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignExpenses extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('expenses', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('expense_category_id');
            $table->foreign('expense_category_id')->references('id')->on('expense_categories');

            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('ware_houses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('expenses', function (Blueprint $table) {
            //
        });
    }
}
