<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_venda',
        'id_cliente',
        'nrParcela',
        'vlParcela',
        'dtParcela',
        'stParcela',
        'idPagamento',
        'linkPagamento',
        'dtPagamento',
        'vlPagamento',
    ];

    public static function getTotalPagoVenda($id_venda){
        return \DB::table('parcelas')
          ->where('id_venda', $id_venda)
          ->where('stParcela', 'Paga')
          ->sum('vlParcela');
    }

    public static function getNrParcelasAbertas($id_venda){
        return \DB::table('parcelas')
          ->where('id_venda', $id_venda)
          ->where('stParcela', 'Aberta')
          ->count();
    }

    public static function listarParcelasCliente($id_cliente){
        return \DB::table('parcelas')
            ->select('parcelas.id','parcelas.nrParcela','parcelas.dtParcela','parcelas.vlParcela','parcelas.stParcela','parcelas.id_venda')
            ->leftJoin('vendas', 'parcelas.id_venda','=','vendas.id')
            ->orderBy('parcelas.dtParcela')
            ->where('vendas.id_cliente', $id_cliente)
            ->get();
    }

    public static function listarParcelasParaReajuste($id_grupo, $data){
        return \DB::table('parcelas')
          ->select('parcelas.id')
          ->join('vendas', 'parcelas.id_venda', '=', 'vendas.id')
          ->where('parcelas.dtParcela', '>=', $data)
          ->where('parcelas.stParcela', '=', 'Aberta')
          ->where('vendas.id_grupo', '=', $id_grupo)
          ->get();
    }

    public static function listarAtrasadas(){
        $data = date('Y-m-d');
        return \DB::table('parcelas')
            ->select('*')
            ->join('clientes', 'parcelas.id_cliente', '=', 'clientes.id')
            ->join('vendas', 'parcelas.id_venda', '=', 'vendas.id')
            ->join('grupos', 'vendas.id_grupo', '=', 'grupos.id')
            ->where('parcelas.stParcela','=','Aberta')
            ->where('parcelas.dtParcela','<',$data)
            ->get()
        ;

    }

    public static function somaValoresEntradaUltimosDias($dias){
        $dataAtual = date('Y-m-d');
        $dataControle = date('Y-m-d', strtotime("-$dias days", strtotime($dataAtual)));
        return \DB::table('parcelas')
            ->where('dtPagamento','>=',$dataControle)
            ->where('dtPagamento','<',$dataAtual)
            ->where('stParcela','=','Paga')
            ->sum('vlPagamento')
        ;
    }

    public static function somaValoresEntradaProximosDias($dias){
        $dataAtual = date('Y-m-d');
        $dataControle = date('Y-m-d', strtotime("+$dias days", strtotime($dataAtual)));
        return \DB::table('parcelas')
            ->where('dtParcela','>=',$dataAtual)
            ->where('dtParcela','<',$dataControle)
            ->where('stParcela','=','Aberta')
            ->sum('vlParcela')
        ;
    }

    public static function pesquisar($dados){

        $sql = "SELECT * FROM parcelas, clientes, vendas, grupos WHERE 1=1";

        if($dados['id_cliente']){
            $sql .= " AND parcelas.id_cliente='$dados[id_cliente]'";
        }

        if($dados['stParcela']){
            $sql .= " AND parcelas.stParcela='$dados[stParcela]'";
        }

        if($dados['dtInc']){
            $sql .= " AND parcelas.dtParcela>='$dados[dtInc]'";
        }

        if($dados['dtFn']){
            $sql .= " AND parcelas.dtParcela<='$dados[dtFn]'";
        }

        if($dados['dtIncPagamento']){
            $sql .= " AND parcelas.dtPagamento>='$dados[dtIncPagamento]'";
        }

        if($dados['dtFnPagamento']){
            $sql .= " AND parcelas.dtPagamento<='$dados[dtFnPagamento]'";
        }

        $sql .= " AND parcelas.id_cliente=clientes.id
        AND parcelas.id_venda=vendas.id
        AND vendas.id_grupo=grupos.id";

        if($dados['id_grupo']){
            $sql .= " AND grupos.id='$dados[id_grupo]'";
        }

        $sql .= " ORDER BY parcelas.dtParcela";

        return \DB::select($sql);
    }

    public static function somaTotalParcelas($id_venda){
        return \DB::table('parcelas')
            ->where('id_venda', $id_venda)
            ->sum('vlParcela');
    }
}
