<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Item;
use App\BongkarMuat;
use App\Transaction;

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

    public function master_item_detail(Request $request)
    {
        $item = Item::find($request->id);
        if (!$item) {
            return response()->json('item tidak ditemukan',400);
        };
        return view('master.item.detail')->with('item', $item::get_item_detail($request->id));
    }

    public function master_transaction_form()
    {
        return view('master.transaction');
    }

    public function master_bongkarmuat_list()
    {
        return view('master.bongkarmuat.list');
    }

    public function page_bongkar()
    {
        $client = Client::get_client_list();
        return view('bongkar')->with('client_data', $client);
    }

    public function master_bongkar_edit(Request $request)
    {
        $bongkar_data = BongkarMuat::get_bongkar_detail($request->id);
        if (!$bongkar_data) {
            return response()->json('data tidak ditemukan',400);
        };
        $item_data = Item::get_client_item($bongkar_data->client_id);
        return view('master.bongkarmuat.editbongkar')->with('bongkar_data', $bongkar_data)->with('item_data', $item_data);
    }

    public function page_muat()
    {
        $client = Client::get_client_list();
        return view('muat')->with('client_data', $client);
    }
    
    public function master_muat_edit(Request $request)
    {
        $muat_data = BongkarMuat::get_muat_detail($request->id);
        if (!$muat_data) {
            return response()->json('data tidak ditemukan',400);
        };
        $item_data = Item::get_client_item($muat_data->client_id);
        return view('master.bongkarmuat.editmuat')->with('muat_data', $muat_data)->with('item_data', $item_data);
    }

    public function report_monthly(Request $request)
    {
        $report_data;
        $report_data = Client::find($request->client_id);
        $report_data->item_data = Transaction::get_client_monthly_items($request->client_id, array('month' => $request->period_month, 'year' => $request->period_year ));
        return view('report.monthly')->with('data', $report_data)->with('period_data', $request);
    }

    public function report_monthly_option()
    {
        $report_data;
        $report_data = Client::get_client_list();
        return view('report.monthly_option')->with('client_data', $report_data);
    }

    public function customer_report(Request $request)
    {
        $client_id = 2;
        $report_data;
        $report_data = Client::find($client_id);
        $report_data->item_data = Item::get_client_item($client_id);
        for ($i=0; $i < count($report_data->item_data); $i++) { 
            $report_data->item_data[$i] = Item::get_item_detail($report_data->item_data[$i]->id);
        }
        return view('report.customer.items')->with('data', $report_data);
    }
}
