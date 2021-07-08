<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artigos extends Model
{
    protected $table = "artigos_crime";
    protected $fillable=[
      'artigo',
      'descrição'
    ];
}
