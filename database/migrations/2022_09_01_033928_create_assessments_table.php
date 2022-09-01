<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_id')->nullable()->constrained('recruitments', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('candidate_id')->constrained('candidates', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('criteria_id')->constrained('criterias', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->float('weight');
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
        Schema::dropIfExists('assessments');
    }
}
