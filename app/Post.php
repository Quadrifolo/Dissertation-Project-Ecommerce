<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    // used to translate the main title/body

    // Table Name 
    protected $table = 'posts';
    // Primary Key 
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

// single post belongs to a user 
    public function user (){

        return $this->belongsTo('App\User');
    }


}