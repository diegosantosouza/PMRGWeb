<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitasArquivos extends Model
{
    protected $table = "visitas_arquivos";
    protected $fillable= [
        'visita_id',
        'path',
        'cover',
    ];
}
