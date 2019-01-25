<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    //
    protected $fillable = [
        'client_id', 'qty', 'nominal',
    ];

    public static function get_client_transaction($client_id){
        $transactions_data = DB::table('transactions')
                ->join('worktypes', 'worktypes.id', '=', 'transactions.worktype_id')
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
