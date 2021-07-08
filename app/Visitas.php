<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Visitas extends Model
{
    protected $fillable = [
        'id_interno',
        'foto',
        'nome',
        'sexo',
        'parentesco',
        'documento',
        'tipo_doc',
        'dt_nascimento',
        'naturalidade',
        'uf',
        'nacionalidade',
        'pai',
        'mae',
        'endereco',
        'cidade',
        'cep',
        'celular',
        'status',
        'antecedentes',
        'autorizacao_judicial',
        'autorizacao_menor',
        'placa',
        'modelo',
        'data_suspencao',
        'observacoes'
    ];

    public function getUrlFotoAttribute()
    {
        if(!empty($this->foto)){
            return Storage::url(Cropper::thumb($this->foto, 300, 300));
        }

        return url(asset('backend/assets/images/avatarDefault.png'));
    }

    public function interno()
    {
        return $this->belongsTo(Interno::class,'id_interno','id')->withDefault(['nome'=>0, 'n'=>0, 'estagio'=>0]);
    }

    public function arquivos()
    {
        return $this->hasMany(VisitasArquivos::class,'visita_id','id');
    }

    public function entradavisitantes()
    {
        return $this->hasMany(EntradaVisitantes::class,'visita_id','id');
    }

    public function setDtNascimentoAttribute($value)
    {
        $this->attributes['dt_nascimento'] = $this->convertStringToDate($value);
    }

    public function getDtNascimentoAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function setAntecedentesAttribute ($value)
    {
        $this->attributes['antecedentes'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setAutorizacao_judicialAttribute ($value)
    {
        $this->attributes['autorizacao_judicial'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setAutorizacao_menorAttribute ($value)
    {
        $this->attributes['autorizacao_menor'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setLaborAttribute ($value)
    {
        $this->attributes['labor'] = ($value === true || $value === 'on' ? 1:null);
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

    public function idade($value)
    {
        /* calcular idade*/
        $hoje = new \DateTime();
        $nascimento = new \DateTime($value);
        return $nascimento->diff($hoje);

    }

}
