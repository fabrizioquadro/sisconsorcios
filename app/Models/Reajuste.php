<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reajuste extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_grupo',
        'dtAniversario',
        'txReajuste',
        'vlReajusteCarta',
        'vlReajusteParcela',
        'id_user',
    ];
}
