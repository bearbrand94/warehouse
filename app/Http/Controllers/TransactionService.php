<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Validator;

class TransactionService extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function get_client_transaction(Request $request){
        $validator = Validator::make(
            array(
                "client_id"=>$request->client_id
            ),
            array(
                "client_id" => 'required'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        return response()->json(Transaction::get_client_transaction($request->client_id));
    }

    public function get_item_transaction(Request $request){
        $validator = Validator::make(
            array(
                "item_id"=>$request->item_id
            ),
            array(
                "item_id" => 'required'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        return response()->json(Transaction::get_item_transaction($request->item_id));
    }
}
