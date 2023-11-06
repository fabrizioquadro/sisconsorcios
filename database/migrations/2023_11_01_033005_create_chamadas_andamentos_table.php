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
        Schema::create('chamadas_andamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_chamada');
            $table->dateTime('dtHrAndamento');
            $table->string('dsInsercao');
            $table->text('dsAndamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamadas_andamentos');
    }
};
