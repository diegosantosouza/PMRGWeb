<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comportamento extends Model
{
    protected $table = "comportamento";

    protected $fillable = [
        'numero',
        'id_interno',
        'pdi_status',
        'assunto',
        'tipo_falta',
        'punicao',
        'data_inicio',
        'data_termino',
        'outra_falta',
    ];

    public function interno()
    {
        return $this->belongsTo(Interno::class,'id_interno','id')->withTrashed();
    }

    public function arquivos()
    {
        return $this->hasMany(ComportamentoArquivos::class,'comportamento_id','id');
    }

    public function setDataInicioAttribute($value)
    {
        $this->attributes['data_inicio'] = $value;
    }

    public function getDataInicioAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d-m-Y', strtotime($value));
    }

    public function setDataTerminoAttribute($value)
    {
        $this->attributes['data_termino'] = $value;
    }

    public function getDataTerminoAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d-m-Y', strtotime($value));
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
