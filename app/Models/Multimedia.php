<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public function actividads(){
        return $this->hasMany('App\Models\actividad');
    }


}