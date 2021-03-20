<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CurrencyRate extends Model
{

    public function getRateAttribute($value)
    {

        return ucfirst($value);

    }
    
}
