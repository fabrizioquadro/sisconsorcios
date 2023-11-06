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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nmCliente');
            $table->string('nrCpf');
            $table->string('nrRg')->nullable();
            $table->string('dsGenero');
            $table->string('dsEmail');
            $table->string('password');
            $table->string('nrTel')->nullable();
            $table->string('nrCel');
            $table->string('nrCep');
            $table->string('dsEndereco');
            $table->string('nrEndereco');
            $table->string('dsComplemento');
            $table->string('dsBairro');
            $table->string('nmCidade');
            $table->string('dsUf');
            $table->string('imagem')->nullable();
            $table->string('customer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
