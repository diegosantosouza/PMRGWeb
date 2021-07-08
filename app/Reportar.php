<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportar extends Model
{
    protected $table = "reportar";
    protected $fillable= [
        'user_nome',
        'user_email',
        'erro',
        'descricao',
        'user_dev',
        'user_dev_email',
        'status'
    ];

}
