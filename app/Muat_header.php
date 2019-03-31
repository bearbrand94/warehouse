<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muat_header extends Model
{
    protected $table='Muat_header';
    protected $fillable = [
        'client_id', 'droporder_id', 'truck_number', 'delivered_at'
    ];
}
