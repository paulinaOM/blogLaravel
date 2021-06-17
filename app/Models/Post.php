<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post'; //Laravel busca en la bd una tabla del mismo nombre del modelo pero en plural, se puede especificar un nombre de  tabla distinto
    const CREATED_AT = 'create_date' ;
    const UPDATED_AT = 'update_date';

    //relacion 1-N post-comentario. Obtiene los comentarios del post
    public function comments(){
        return $this-> hasMany('App\Models\Comment');
    }

    public function user(){  //un post pertenece a un usuario
        return $this-> belongsTo('App\Models\User');
    }
}
