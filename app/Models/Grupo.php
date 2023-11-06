<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmBanco',
        'nrGrupo',
        'nrPrazo',
        'vlCarta',
        'vlCartaOriginal',
        'txAdmin',
        'dtInicio',
        'dtProxAniversario',
        'nrAbertos',
        'nrContemplados',
        'nrResgatados',
        'stGrupo',
    ];

    public function atualizaNrParticipantes(){
        //vamos buscar todas as vendas que estao abertas
        $nrAbertos = \DB::table('vendas')->where('stVenda','=','Aberta')->count();
        $nrContemplados = \DB::table('vendas')->where('stVenda','=','Contemplada')->count();
        $nrResgatados = \DB::table('vendas')->where('stVenda','=','Resgatada')->count();

        $dados['nrAbertos'] = $nrAbertos;
        $dados['nrContemplados'] = $nrContemplados;
        $dados['nrResgatados'] = $nrResgatados;
        $this::update($dados);
    }

    public static function pesquisar($dados){
        $sql = "SELECT * FROM grupos WHERE 1=1";

        if($dados['dtIncCadastro']){
            $sql .= " AND created_at >= '$dados[dtIncCadastro]''";
        }

        if($dados['dtFnCadastro']){
            $sql .= " AND created_at <= '$dados[dtFnCadastro]''";
        }

        if($dados['dtIncOperacao']){
            $sql .= " AND dtInicio >= '$dados[dtIncOperacao]''";
        }

        if($dados['dtFnOperacao']){
            $sql .= " AND dtInicio <= '$dados[dtFnOperacao]'";
        }

        if($dados['dtIncAniver']){
            $sql .= " AND dtProxAniversario >= '$dados[dtIncAniver]'";
        }

        if($dados['dtFnAniver']){
            $sql .= " AND dtProxAniversario <= '$dados[dtFnAniver]'";
        }

        if($dados['stGrupo']){
            $sql .= " AND stGrupo <= '$dados[stGrupo]'";
        }

        $sql .= " ORDER BY nrGrupo, nmBanco";

        return \DB::select($sql);
    }
}
