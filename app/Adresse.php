<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    //Déclaration des champs qui pourront être remplis via la validation du formulaire.
    protected $fillable = ['prenom','nom','adresse','adresse2','telephone','code_postale','ville','pays'];
}
