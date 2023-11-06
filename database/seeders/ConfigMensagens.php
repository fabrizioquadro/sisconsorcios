<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConfigMensagem;

class ConfigMensagens extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigMensagem::create([
            "useRecuperarSenha" => "Não",
            "useClienteCadastro" => "Não",
            "useClienteAlterarSenha" => "Não",
            "useVenda" => "Não",
            "useGrupoContemplado" => "Não",
            "useGrupoResgate" => "Não",
        ]);
    }
}
