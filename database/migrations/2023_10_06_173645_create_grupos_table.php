<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nmBanco');
            $table->string('nrGrupo');
            $table->integer('nrPrazo');
            $table->double('vlCarta', 10, 2);
            $table->double('vlCartaOriginal', 10, 2);
            $table->double('txAdmin');
            $table->date('dtInicio');
            $table->date('dtProxAniversario');
            $table->integer('nrAbertos');
            $table->integer('nrContemplados');
            $table->integer('nrResgatados');
            $table->string('stGrupo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
