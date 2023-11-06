<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoCliente extends Model
{
    protected $table = 'arquivos_cliente';
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'nmArquivo',
        'arquivo',
    ];
}
