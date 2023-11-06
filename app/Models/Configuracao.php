<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;

    protected $table = "configuracoes";

    protected $fillable = [
        'nmSistema',
        'dsTitulo',
        'logo',
        'stMensagemCad',
        'dsMensagemCad',
        'stMensagemSenha',
        'dsMensagemSenha',
        'stMensagemContemplacao',
        'dsMensagemContemplacao',
        'asaas_client',
        'asaas_method',
    ];
}
