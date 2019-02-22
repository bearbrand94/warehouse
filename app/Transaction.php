<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'item_id', 'client_id', 'ref_id', 'ref_table_name', 'qty', 'nominal', 'note', 'desc'
    ];

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
