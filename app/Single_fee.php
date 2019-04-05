<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Single_fee extends Model
{
	use SoftDeletes;
    //
    protected $fillable = [
        'item_id', 'name', 'price',
    ];
}
