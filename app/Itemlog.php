<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itemlog extends Model
{
    //
    protected $fillable = [
        'item_id', 'worktype_id', 'qty', 'note',
    ];
}
