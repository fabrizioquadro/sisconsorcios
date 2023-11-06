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
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id();
            $table->string('nmSistema');
            $table->string('dsTitulo');
            $table->string('logo');
            $table->string('stMensagemCad');
            $table->text('dsMensagemCad');
            $table->string('stMensagemSenha');
            $table->text('dsMensagemSenha');
            $table->string('stMensagemContemplacao');
            $table->text('dsMensagemContemplacao');
            $table->text('asaas_client');
            $table->string('asaas_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes');
    }
};
