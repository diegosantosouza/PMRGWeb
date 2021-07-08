<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advogados extends Model
{
    protected $fillable = [
        'id_interno',
        'nome_advogado',
        'oab',
    ];
}
