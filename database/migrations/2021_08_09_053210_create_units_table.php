<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
<<<<<<< HEAD
            $table->integer('base_unit')->default(0);
=======
<<<<<<< HEAD
            $table->string('base_unit')->nullable()->default(0);
=======
            $table->string('base_unit')->default('0');
>>>>>>> 8fff63f960b536cca343e08d6801b64927aee15d
>>>>>>> 4243fae674fd399f572ce97c3c60a80f3da64f45
            $table->string('operator')->nullable();
            $table->string('operation_value')->nullable();
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
        Schema::dropIfExists('units');
    }
}
