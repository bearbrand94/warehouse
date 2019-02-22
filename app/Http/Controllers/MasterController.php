<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
class MasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.client');
    }

    public function master_client_list()
    {
        return view('master.client.list');
    }

    public function master_client_new()
    {
        return view('master.client.new');
    }

    public function master_client_edit(Request $request)
    {
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json('client tidak ditemukan',400);
        };
        return view('master.client.edit')->with('client', $client);
    }
    
    public function master_client_detail(Request $request)
    {
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json('client tidak ditemukan',400);
        };
        return view('master.client.detail')->with('client', $client);
    }

    public function master_item_list()
    {
        return view('master.item.list');
    }

    public function master_transaction_form()
    {
        return view('master.transaction');
    }
}
