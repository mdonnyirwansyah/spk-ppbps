<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_id')->nullable()->constrained('recruitments', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', '128');
            $table->enum('type', ['Cost', 'Benefit']);
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
        Schema::dropIfExists('criterias');
    }
}
