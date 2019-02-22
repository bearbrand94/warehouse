<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'name', 'unit_name', 'qty',
    ];

    public static function get_item_list(){
        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by')
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }
    
    public static function get_client_item($client_id){
        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by')
                ->where('items.client_id', $client_id)
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }

    public static function get_item_fees($item_id){
        $single_fees = DB::table('single_fees')
                ->select('single_fees.id', 'single_fees.name', 'single_fees.price')
                ->where('single_fees.item_id', $item_id);

        $all_fees = DB::table('recurring_fees')
                ->select('recurring_fees.id', 'recurring_fees.name', 'recurring_fees.price')
                ->where('recurring_fees.item_id', $item_id)
                ->union($single_fees);

        return $single_fees->get();
    }

    public static function get_item_detail($item_id){
        $item_data = DB::table('itemlogs')
                ->join('single_fees', 'single_fees.id', '=', 'itemlogs.fee_ref_id')
                ->join('items', 'items.id', '=', 'itemlogs.item_id')
                ->select('itemlogs.*', 'items.name as item_name', 'single_fees.price as price_each')
                ->where('items.id', $item_id)
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }
}
