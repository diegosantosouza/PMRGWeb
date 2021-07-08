<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComportamentoArquivos extends Model
{
    protected $table = "comportamento_arquivos";

    protected $fillable = [
        'comportamento_id',
        'path',
        'cover',
    ];
}
