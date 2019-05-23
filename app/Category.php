<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //on récupère les produits dans une catégorie
    public function products() {
        return $this->hasMany('App\Product','id_category');
    }

    // on récupère les catégories enfant d'une catégorie
    public function childrens(){
        return $this->hasMany('App\Category','id_parent');
    }

    // recupere le parent d'une catégorie
    public function parent(){
        return $this->belongsTo('App\Category','id_parent');
    }
}
