<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovCarcerario extends Model
{
    protected $table = "movcarcerario";

    protected $fillable = [
        'id_interno',
        'celaanterior',
        'estagioanterior',
        'celaatual',
        'estagioatual',
        'created_at',
    ];

    public function getcreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}
