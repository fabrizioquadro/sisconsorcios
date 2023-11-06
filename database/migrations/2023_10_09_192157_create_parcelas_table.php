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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venda');
            $table->unsignedBigInteger('id_cliente');
            $table->integer('nrParcela');
            $table->double('vlParcela', 10,2);
            $table->date('dtParcela');
            $table->string('stParcela');
            $table->string('idPagamento')->nullable();
            $table->string('linkPagamento')->nullable();
            $table->date('dtPagamento')->nullable();
            $table->double('vlPagamento', 10, 2)->nullable();
            $table->foreign('id_venda')->references('id')->on('vendas');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};
