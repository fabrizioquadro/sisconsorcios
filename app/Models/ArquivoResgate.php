<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoResgate extends Model
{
    use HasFactory;
    protected $table = 'arquivos_resgate';

    protected $fillable = [
        'id_venda',
        'id_cliente',
        'nmArquivo',
        'arquivo',
    ];
}
