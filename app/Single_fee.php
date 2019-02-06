<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Single_fee extends Model
{
    //
    protected $fillable = [
        'item_id', 'name', 'price',
    ];
}
