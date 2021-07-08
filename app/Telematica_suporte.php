<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telematica_suporte extends Model
{
    protected $table = "telematica_suport";
    protected $fillable= [
        'solicitante_nome',
        'solicitante_re',
        'ip',
        'solicitante_secao',
        'descricao',
        'suporte_nome',
        'suporte_re',
        'solucao',
        'classificacao',
        'finalizado',
        'created_at',
    ];

    public function modalidade()
    {
        return $this->hasOne(Telematica_classificacao::class, 'id', 'classificacao')->withDefault(['classificacao'=>'']);
    }

    public function setcreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function getcreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function setFinalizadoAttribute ($value)
    {
        $this->attributes['finalizado'] = ($value === true || $value === 'on' ? 1:null);
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
