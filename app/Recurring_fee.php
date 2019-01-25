<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurring_fee extends Model
{
    //
    protected $fillable = [
        'item_id', 'name', 'price', 'recurring_type', 'recurring_date'
    ];
}
