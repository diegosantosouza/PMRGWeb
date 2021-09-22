<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legislacao extends Model
{
    protected $table = "legislacao";
    protected $fillable =[
        'id_processo',
        'legislacao',
        'leis_especiais',
        'artigo',
        'descricao'
    ];
}
