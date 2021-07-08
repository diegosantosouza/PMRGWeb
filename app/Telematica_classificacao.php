<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telematica_classificacao extends Model
{
    protected $table = "telematica_classificacao";

    protected $fillable= [
        'classificacao',
    ];

}
