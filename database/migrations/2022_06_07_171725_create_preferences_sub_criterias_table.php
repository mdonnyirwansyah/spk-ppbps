<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesSubCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences_sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sub_criteria_id')->constrained('sub_criterias', 'id')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('preferences_sub_criterias');
    }
}
