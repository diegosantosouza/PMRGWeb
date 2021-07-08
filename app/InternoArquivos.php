<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternoArquivos extends Model
{
    protected $table = "internos_arquivos";
    protected $fillable= [
        'interno_id',
        'path',
        'cover',
    ];
}
