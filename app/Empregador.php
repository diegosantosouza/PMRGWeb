<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empregador extends Model
{
    protected $table = "empregadores";

    protected $fillable = [
      'empregador',
      'horario_semana',
      'horario_fim_semana'
    ];

    public function internos()
    {
        return $this->hasMany(Interno::class,'empregador','id');
    }
}
