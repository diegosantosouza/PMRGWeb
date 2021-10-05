<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Interno extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'nome_completo',
        'foto',
        'sexo',
        'orientacao_sexual',
        'rg',
        'org_expedidor',
        'cpf',
        'titulo_eleitor',
        'zona',
        'secao',
        'nacionalidade',
        'natural',
        'estado',
        'nascimento',
        'idade',
        'estado_civil',
        'conjugue',
        'pai',
        'mae',
        'escolaridade',
        'religiao',
        'etnia',
        'cabelos',
        'olhos',
        'altura',
        'peso',
        'defeitos_fisicos',
        'sinais_nascenca',
        'cicatrizes',
        'tatuagens',
        'endereco',
        'cidade',
        'telefone',
        'acidente_doenca_morte',

        'nome_guerra',
        're',
        'funcional',
        'patente',
        'situacao',
        'batalhao',
        'batalhao_cidade',
        'admissao',
        'demissao',

        'n',
        'status',
        'alojamento',
        'estagio',
        'assistencia_juridica',
        'procedencia',
        'captura_procurado',
        'captura_estado',
        'tipo_prisao',
        'data_liberdade_remocao',
        'local',
        'sit_anterior_prisao',

        'observacoes',
        'estudo',
        'empregador',
        'comportamento_status',
        'comportamento_data',
        'created_at'
    ];

    public function trabalho()
    {
        return $this->hasOne(Empregador::class, 'id', 'empregador');
    }

    public function ensino()
    {
        return $this->hasOne(Estudo::class, 'id', 'estudo');
    }

    public function processos()
    {
        return $this->hasMany(Processos::class, 'id_interno', 'id');
    }

    public function legislacao()
    {
        return $this->hasManyThrough(Legislacao::class, Processos::class, 'id_interno', 'id_processo', 'id','id');
    }

    public function arquivos()
    {
        return $this->hasMany(InternoArquivos::class, 'interno_id', 'id');
    }

    public function visitas()
    {
        return $this->hasMany(Visitas::class, 'id_interno', 'id');
    }

    public function registrosVistas()
    {
        return $this->hasManyThrough(EntradaVisitantes::class, Visitas::class, 'id_interno', 'visita_id', 'id','id');
    }

    public function advogados()
    {
        return $this->hasMany(Advogados::class, 'id_interno', 'id');
    }

    public function comportamento()
    {
        return $this->hasMany(Comportamento::class, 'id_interno', 'id');
    }

    public function movcarcerario()
    {
        return $this->hasMany(MovCarcerario::class, 'id_interno', 'id');
    }


    public function getUrlFotoAttribute()
    {
        if (!empty($this->foto)) {
            return Storage::url(Cropper::thumb($this->foto, 300, 300));
        }

        return url(asset('backend/assets/images/avatarDefault.png'));
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = $this->clearField($value);
    }

    public function setNascimentoAttribute($value)
    {
        $this->attributes['nascimento'] = $this->convertStringToDate($value);
    }

    public function getNascimentoAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = $this->clearField($value);
        if(empty($value)){
            $this->attributes['telefone'] = null;
        }
    }

    public function setAdmissaoAttribute($value)
    {
        $this->attributes['admissao'] = $this->convertStringToDate($value);
    }

    public function getAdmissaoAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function setDemissaoAttribute($value)
    {
        $this->attributes['demissao'] = $this->convertStringToDate($value);
    }

    public function getDemissaoAttribute($value)
    {
        if (!empty($value)) {
            return date('d-m-Y', strtotime($value));
        }
    }

    public function setDataLiberdadeRemocaoAttribute($value)
    {
        $this->attributes['data_liberdade_remocao'] = $this->convertStringToDate($value);
    }

    public function getDataLiberdadeRemocaoAttribute($value)
    {
        if (!empty($value)) {
            return date('d/m/Y', strtotime($value));
        }
    }

    public function setComportamentoDataAttribute($value)
    {
        $this->attributes['comportamento_data'] = $value;
    }

    public function getComportamentoDataAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d-m-Y', strtotime($value));
    }

    public function setcreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $this->convertStringToDate($value);
    }

    public function getcreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    private function clearField(?string $param)
    {
        if (empty($param)) {
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
