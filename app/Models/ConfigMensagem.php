<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigMensagem extends Model
{
    protected $table = 'config_mensagem';
    use HasFactory;

    protected $fillable = [
        'useRecuperarSenha',
        'dsRecuperarSenha',
        'useClienteCadastro',
        'dsClienteCadastro',
        'useClienteAlterarSenha',
        'dsClienteAlterarSenha',
        'useVenda',
        'dsVenda',
        'useGrupoContemplado',
        'dsGrupoContemplado',
        'useGrupoResgate',
        'dsGrupoResgate',
    ];

}
