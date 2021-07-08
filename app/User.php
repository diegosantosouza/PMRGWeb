<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 're',  'email', 'password', 'ativo', 'admin', 'foto', 'penal', 'labor', 'juridica', 'pmjd', 'escolta', 'guarda', 'naps', 'uis', 'uge', 'p1', 'p2', 'p4', 'p5', 'secao', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Foto
     */
    public function getUrlFotoAttribute()
    {
        if(!empty($this->foto)){
            return Storage::url(Cropper::thumb($this->foto, 500, 500));
        }

        return '';
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setAtivoAttribute ($value)
    {
        $this->attributes['ativo'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setAdminAttribute ($value)
    {
        $this->attributes['admin'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setPenalAttribute ($value)
    {
        $this->attributes['penal'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setLaborAttribute ($value)
    {
        $this->attributes['labor'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setJuridicaAttribute ($value)
    {
        $this->attributes['juridica'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setPjmdAttribute ($value)
    {
        $this->attributes['pjmd'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setEscoltaAttribute ($value)
    {
        $this->attributes['escolta'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setGuardaAttribute ($value)
    {
        $this->attributes['guarda'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setNapsAttribute ($value)
    {
        $this->attributes['naps'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setUisAttribute ($value)
    {
        $this->attributes['uis'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setUgeAttribute ($value)
    {
        $this->attributes['uge'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setP1Attribute ($value)
    {
        $this->attributes['p1'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setP2Attribute ($value)
    {
        $this->attributes['p2'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setP4Attribute ($value)
    {
        $this->attributes['p4'] = ($value === true || $value === 'on' ? 1:null);
    }

    public function setP5Attribute ($value)
    {
        $this->attributes['p5'] = ($value === true || $value === 'on' ? 1:null);
    }
}
