<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChamadaAndamento extends Model
{
    use HasFactory;

    protected $table = "chamadas_andamentos";

    protected $fillable = [
        'id_chamada',
        'dtHrAndamento',
        'dsInsercao',
        'dsAndamento',
    ];
}
