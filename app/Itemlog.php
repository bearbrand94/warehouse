<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itemlog extends Model
{
    //
    protected $fillable = [
        'item_id', 'ref_table_name', 'ref_id', 'qty', 'note', 'type', 'created_at'
    ];
}
