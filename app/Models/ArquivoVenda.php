<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoVenda extends Model
{
    protected $table = 'arquivos_venda';
    use HasFactory;

    protected $fillable = [
        'id_venda',
        'id_cliente',
        'nmArquivo',
        'arquivo',
    ];
}
