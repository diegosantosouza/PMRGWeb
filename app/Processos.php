<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processos extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'id_interno',
        'em_servico',
        'processo_de_execucao',
        'regime',
        'n_inquerito',
        'multa',
        'sit_processual',
        'reincidencia',

        'pena_ano',
        'pena_meses',
        'pena_dias',

        'medida_tratamento',
        'comutacao',
        'transito_julgado',
        'exticao_punibilidade',
        'origem_processo',

        'assist_juridica',
        'vara_comarca',
        'data_prisao',
        'processo_referencia'

    ];

    public function interno()
    {
        return $this->belongsTo(Interno::class,'id_interno','id')->withDefault(['n'=>0]);
    }

    public function legislacao()
    {
        return $this->hasMany(Legislacao::class,'id_processo','id');
    }

    public function setDataPrisaoAttribute($value)
    {
        $this->attributes['data_prisao'] = $this->convertStringToDate($value);
    }

    public function getDataPrisaoAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    private function clearField(?string $param)
    {
        if(empty($param)){
            return '';
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
