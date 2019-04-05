<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muat_footer extends Model
{
    //
    protected $table='Muat_footer';
    
    protected $fillable = [
        'header_id', 'item_id', 'qty', 'note'
    ];
}
