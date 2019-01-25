<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'name', 'unit_name', 'qty',
    ];

    public static function get_client_item($client_id){
        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by')
                ->where('items.client_id', $client_id)
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }

    public static function get_item_detail($item_id){
        $item_data = DB::table('itemlogs')
                ->join('worktypes', 'worktypes.id', '=', 'itemlogs.worktype_id')
                ->join('items', 'items.id', '=', 'itemlogs.item_id')
                ->select('itemlogs.*', 'items.name as item_name', 'worktypes.name as work_name')
                ->where('items.id', $item_id)
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }
}
