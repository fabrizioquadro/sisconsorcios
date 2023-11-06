<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            "nmCliente" => "Fabrizio Silveira Quadro",
            "nrCpf" => "808.723.790-00",
            "nrRg" => "5072451726",
            "dsGenero" => "Masculino",
            "dsEmail" => "fabrizio.quadro@gmail.com",
            "password" => bcrypt('fabrizio'),
            "nrTel" => '(55) 3243-3778',
            "nrCel" => '(55) 99211-8977',
            "nrCep" => '97572678',
            "dsEndereco" => 'Almirante Saldanha da Gama',
            "nrEndereco" => '630',
            "dsComplemento" => 'lote',
            "dsBairro" => 'Divisa',
            "nmCidade" => 'Santana do Livramento',
            "dsUf" => 'RS',
        ]);
    }
}
