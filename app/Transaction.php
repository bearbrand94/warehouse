<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Transaction extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'item_id', 'client_id', 'ref_id', 'ref_table_name', 'qty', 'nominal', 'note', 'desc'
    ];

    public static function get_client_monthly_items($client_id, $period = array()){
        $period = $period ? $period : [];
        $period['month'] = $period['month'] ? $period['month'] : Carbon::now()->format('m');
        $period['year'] = $period['year'] ? $period['year'] : Carbon::now()->format('Y');

        $item_data = DB::table('item_category')
                ->select('*')
                ->where('client_id', $client_id)
                ->orderBy('updated_at', 'desc')->get();
        // return $item_data;

        for ($i=0; $i < count($item_data); $i++) { 
            $item_data[$i]->items = DB::table('items')
                ->select('items.name', 'items.unit_name', 'items.qty as sisa', 'itemlogs.*')
                ->join('itemlogs', 'itemlogs.item_id', 'items.id')
                ->where('items.category_id', $item_data[$i]->id)
                ->whereMonth('itemlogs.created_at', '>=', $period['month'])
                ->whereYear('itemlogs.created_at', '>=', $period['year'])
                ->orderBy('itemlogs.created_at', 'asc')->get();

            $total_keluar = 0;
            $total_masuk = 0;
            foreach ($item_data[$i]->items as $item) {
                if($item->type=="subtraction"){
                    $total_keluar += $item->qty;
                }
                else if($item->type=="addition"){
                    $total_masuk += $item->qty;
                }
            }
            $item_data[$i]->total_keluar = $total_keluar;
            $item_data[$i]->total_masuk = $total_masuk;
            $item_data[$i]->total_sisa = DB::table('items')->where('items.category_id', $item_data[$i]->id)->sum('items.qty');
        }
        return $item_data;
    }

    public static function get_client_transaction($client_id){
        $transactions_data = DB::table('transactions')
                ->join('items', 'items.id', '=', 'transactions.item_id')
                ->select('transactions.*')
                ->where('items.client_id', $client_id)
                ->orderBy('updated_at', 'desc');
        return $transactions_data->get();
    }

    public static function get_item_transaction($item_id){
        $transactions_data = DB::table('transactions')
                ->join('worktypes', 'worktypes.id', '=', 'transactions.worktype_id')
                ->join('items', 'items.id', '=', 'transactions.item_id')
                ->select('transactions.*')
                ->where('items.id', $item_id)
                ->orderBy('updated_at', 'desc');
        return $transactions_data->get();
    }
}
