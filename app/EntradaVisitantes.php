<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaVisitantes extends Model
{
    protected $table = "entradavisitantes";

    protected $fillable = [
        'visita_id',
        'menor_12',
        'interno_id',
        'chegada',
        'saida'
    ];

    public function visitas()
    {
        return $this->belongsTo(Visitas::class,'visita_id','id');
    }
    public function interno()
    {
        return $this->belongsTo(Interno::class,'interno_id','id');
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
