<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Nel $fillable dobbiamo aggiungere anche la foreign key visto che verrà passato anch'esso dall'utente 
    protected $fillable = ['title', 'content', 'slug', 'category_id', 'image'];

    //Funzione che andremo a richiamare come dato del post(in admin/index.blade.php) NB!!! non gli piace il pascal case nella nominazione
    public function category(){
        //Qui andiamo a stabilire la relazione many to 1 e a chi è riferita 
        return $this->belongsTo('App\Category');
    }

    //Settiamo la relazione con la tabella tags
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}

