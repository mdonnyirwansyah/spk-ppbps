<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->nullable()->constrained('criterias', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('name', '32');
            $table->enum('rating', ['Sangat Tinggi', 'Tinggi', 'Cukup', 'Rendah', 'Sangat Rendah']);
            $table->float('weight');
            $table->string('slug', '128');
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
        Schema::dropIfExists('sub_criterias');
    }
}
