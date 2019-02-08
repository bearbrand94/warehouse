<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring_fee extends Model
{
	use SoftDeletes;
    //
    protected $fillable = [
        'item_id', 'name', 'price', 'recurring_type', 'recurring_date'
    ];
}
