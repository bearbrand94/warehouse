<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bongkar_footer extends Model
{
    //
    protected $table='bongkar_footer';
    
    protected $fillable = [
        'header_id', 'item_id', 'qty', 'note'
    ];
}
