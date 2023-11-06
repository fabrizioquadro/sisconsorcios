<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_grupo',
        'id_cliente',
        'dtVenda',
        'vlCarta',
        'vlTotal',
        'nrParcelas',
        'dsObs',
        'id_usuario_venda',
        'stVenda',
        'dtContemplacao',
        'dsContemplacao',
        'id_usuario_contemplacao',
        'dtResgate',
        'vlResgate',
        'dsResgate',
        'id_usuario_resgate',
    ];

    public static function numeroVendasGrupo($id_grupo){
        return self::where('id_grupo', $id_grupo)->count();
    }

    public static function listarCotistasGrupo($id_grupo){
        return \DB::table('vendas')
            ->select('vendas.id','vendas.dtVenda','vendas.nrParcelas','vendas.stVenda','clientes.nrCpf','clientes.nmCliente','clientes.dsEmail','clientes.nrTel','clientes.nrCel')
            ->leftJoin('clientes', 'vendas.id_cliente','=','clientes.id')
            ->leftJoin('grupos', 'vendas.id_grupo','=','grupos.id')
            ->orderBy('clientes.nmCliente')
            ->where('vendas.id_grupo','=',$id_grupo)
            ->get();
    }

    public static function listarVendasCliente($id_cliente){
        return \DB::table('vendas')
            ->select('vendas.id','vendas.dtVenda','vendas.vlCarta','vendas.nrParcelas','vendas.stVenda','grupos.nmBanco','grupos.nrGrupo')
            ->leftJoin('grupos', 'vendas.id_grupo','=','grupos.id')
            ->orderBy('vendas.dtVenda')
            ->where('vendas.id_cliente','=',$id_cliente)
            ->get();
    }

    public static function pesquisar($dados){
        $sql = "SELECT * FROM vendas
        LEFT JOIN clientes ON (vendas.id_cliente = clientes.id)
        LEFT JOIN grupos ON (vendas.id_grupo = grupos.id)
        WHERE 1=1";

        if($dados['id_cliente']){
            $sql .= " AND vendas.id_cliente = '$dados[id_cliente]'";
        }

        if($dados['id_grupo']){
            $sql .= " AND vendas.id_grupo = '$dados[id_grupo]'";
        }

        if($dados['dtInc']){
            $sql .= " AND vendas.dtVenda >= '$dados[dtInc]'";
        }

        if($dados['dtFn']){
            $sql .= " AND vendas.dtVenda <= '$dados[dtFn]'";
        }

        $sql .= ' ORDER BY dtVenda';

        return \DB::select($sql);
    }

    public static function getContemplacoes($dados){
        $sql = "SELECT * FROM vendas
        LEFT JOIN clientes ON (vendas.id_cliente = clientes.id)
        LEFT JOIN grupos ON (vendas.id_grupo = grupos.id)
        WHERE vendas.dtContemplacao<>'NULL'";

        if($dados['dtInc']){
            $sql .= " AND vendas.dtContemplacao>='$dados[dtInc]'";
        }

        if($dados['dtFn']){
            $sql .= " AND vendas.dtContemplacao<='$dados[dtFn]'";
        }

        if($dados['id_grupo']){
            $sql .= " AND vendas.id_grupo<='$dados[id_grupo]'";
        }

        $sql .= "ORDER BY dtContemplacao";

        return \DB::select($sql);
    }


    public static function getResgatados($dados){
        $sql = "SELECT * FROM vendas
        LEFT JOIN clientes ON (vendas.id_cliente = clientes.id)
        LEFT JOIN grupos ON (vendas.id_grupo = grupos.id)
        WHERE vendas.dtResgate<>'NULL'";

        if($dados['dtInc']){
            $sql .= " AND vendas.dtResgate>='$dados[dtInc]'";
        }

        if($dados['dtFn']){
            $sql .= " AND vendas.dtResgate<='$dados[dtFn]'";
        }

        if($dados['id_grupo']){
            $sql .= " AND vendas.id_grupo<='$dados[id_grupo]'";
        }

        $sql .= "ORDER BY dtResgate";

        return \DB::select($sql);
    }

    /*
    public static function atualizaVendasNãoResgatadas($id_grupo, $vlCarta){
        Venda::where('id_grupo', $id_grupo)
            ->where('stVenda','<>','Resgatada')
            ->update(['vlCarta'=>$vlCarta]);
    }
    */

}
