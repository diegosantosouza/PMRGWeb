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

    public function setChegadaAttribute($value)
    {
        $this->attributes['chegada'] = $value;
    }

    public function getChegadaAttribute($value)
    {
        if (!empty($value)){
            return date('d-m-Y H:i:s', strtotime($value));
        }
    }

    public function setSaidaAttribute($value)
    {
        $this->attributes['saida'] = $value;
    }

    public function getSaidaAttribute($value)
    {
        if (!empty($value)){
            return date('d-m-Y H:i:s', strtotime($value));
        }
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
