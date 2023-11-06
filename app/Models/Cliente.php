<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmCliente',
        'nrCpf',
        'nrRg',
        'dsGenero',
        'dsEmail',
        'password',
        'nrTel',
        'nrCel',
        'nrCep',
        'dsEndereco',
        'nrEndereco',
        'dsComplemento',
        'dsBairro',
        'nmCidade',
        'dsUf',
        'imagem',
    ];

    public static function pesquisar($dados){
        //vamos montar manualmente o sql
        $tabelas = "clientes";
        $sql = "";
        if($dados['nmCliente']){
            $sql .= " AND clientes.nmCliente LIKE '%$dados[nmCliente]%'";
        }

        if($dados['dtInc']){
            $sql .= "AND clientes.created_at >= '$dados[dtInc]'";
        }

        if($dados['dtFn']){
            $sql .= "AND clientes.created_at <= '$dados[dtFn]'";
        }

        if($dados['id_grupo']){
            $tabelas = "clientes, vendas";
            $sql .= " AND clientes.id = vendas.id_cliente
            AND vendas.id_grupo='$dados[id_grupo]'";
        }

        $sql = "SELECT * FROM $tabelas WHERE 1=1".$sql;

        return \DB::select($sql);
    }
}
