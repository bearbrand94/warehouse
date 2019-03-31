<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bongkar_header extends Model
{
    //
    protected $table='Bongkar_header';
    protected $fillable = [
        'client_id', 'droporder_id', 'truck_number', 'delivered_at', 'created_at'
    ];
}
