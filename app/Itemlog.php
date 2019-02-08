<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itemlog extends Model
{
    //
    protected $fillable = [
        'item_id', 'fee_ref_id', 'qty', 'note',
    ];
}
