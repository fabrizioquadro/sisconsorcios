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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_grupo');
            $table->unsignedBigInteger('id_cliente');
            $table->date('dtVenda');
            $table->double('vlCarta', 10,2);
            $table->double('vlTotal', 10,2);
            $table->integer('nrParcelas');
            $table->text('dsObs')->nullable();
            $table->unsignedBigInteger('id_usuario_venda');
            $table->string('stVenda');
            $table->date('dtContemplacao')->nullable();
            $table->text('dsContemplacao')->nullable();
            $table->unsignedBigInteger('id_usuario_contemplacao')->nullable();
            $table->date('dtResgate')->nullable();
            $table->double('vlResgate',10,2)->nullable();
            $table->text('dsResgate')->nullable();
            $table->unsignedBigInteger('id_usuario_resgate')->nullable();
            $table->foreign('id_grupo')->references('id')->on('grupos');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_usuario_venda')->references('id')->on('users');
            $table->foreign('id_usuario_contemplacao')->references('id')->on('users');
            $table->foreign('id_usuario_resgate')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
