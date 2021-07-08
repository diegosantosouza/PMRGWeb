<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudo extends Model
{
    protected $table = "estudo";
    protected $fillable = [
        'instituicao_ensino',
        'horario_semana',
        'horario_fim_semana'
    ];

    public function internos()
    {
        return $this->hasMany(Interno::class,'estudo','id');
    }
}
