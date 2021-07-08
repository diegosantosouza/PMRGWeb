<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alojamentos extends Model
{

    protected $fillable = [
        'estagio',
        'cela',
        'capacidade',
        'vagas'
    ];
}
