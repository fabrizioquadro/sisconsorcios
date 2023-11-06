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
        Schema::create('reajustes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_grupo');
            $table->date('dtAniversario');
            $table->double('txReajuste', 10, 2);
            $table->double('vlReajusteCarta', 10, 2);
            $table->double('vlReajusteParcela', 10, 2);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_grupo')->references('id')->on('grupos');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reajustes');
    }
};
