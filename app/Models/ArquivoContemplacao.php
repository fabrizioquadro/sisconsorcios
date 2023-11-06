<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoContemplacao extends Model
{
    use HasFactory;
    protected $table = 'arquivos_contemplacao';

    protected $fillable = [
        'id_venda',
        'id_cliente',
        'nmArquivo',
        'arquivo',
    ];
}
