<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Qui andiamo a stabilire la relazione 1 to many e a chi è riferita
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
