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
        Schema::create('config_mensagem', function (Blueprint $table) {
            $table->id();
            $table->string('useRecuperarSenha');
            $table->text('dsRecuperarSenha')->nullable();
            $table->string('useClienteCadastro');
            $table->text('dsClienteCadastro')->nullable();
            $table->string('useClienteAlterarSenha');
            $table->text('dsClienteAlterarSenha')->nullable();
            $table->string('useVenda');
            $table->text('dsVenda')->nullable();
            $table->string('useGrupoContemplado');
            $table->text('dsGrupoContemplado')->nullable();
            $table->string('useGrupoResgate');
            $table->text('dsGrupoResgate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_mensagem');
    }
};
