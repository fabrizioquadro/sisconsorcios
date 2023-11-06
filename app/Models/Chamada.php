<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'dtHrChamada',
        'dsChamada',
        'dsVisualizarCliente',
        'dsVisualizarAdmin',
        'stChamada',
    ];

    public static function listar(){
        return \DB::table('chamadas')
            ->select('*','chamadas.id AS id_chamada')
            ->leftJoin('clientes', 'chamadas.id_cliente','=','clientes.id')
            ->get();
    }
}
