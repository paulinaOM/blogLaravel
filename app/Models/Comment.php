<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comment';
    const CREATED_AT = 'create_date' ;
    const UPDATED_AT = 'update_date';

    public function comments(){
        return $this-> belongsTo('App\Models\Post');
    }
}
