<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceSubCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_sub_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preference_id')->constrained('preferences', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sub_criteria_id')->constrained('sub_criterias', 'id')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preference_sub_criteria');
    }
}
