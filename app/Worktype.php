<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worktype extends Model
{
    //
    protected $fillable = [
        'item_id', 'name', 'price',
    ];
}
