<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Item;
use App\Itemlog;
use App\Single_fee;
use App\Bongkar_header;
use App\Bongkar_footer;
use App\Muat_header;
use App\Muat_footer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;


class ItemService extends Controller
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

    public function get_item(Request $request){
        return response()->json(Item::get_item_list());
    }

    public function get_client_item(Request $request){
        $validator = Validator::make(
            array(
                "client_id" =>  $request->client_id
            ),
            array(
                "client_id" => 'required|exists:clients,id'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        return response()->json(Item::get_client_item($request->client_id));
    }

    public function get_client_item_category(Request $request){
        $validator = Validator::make(
            array(
                "client_id" =>  $request->client_id
            ),
            array(
                "client_id" => 'required|exists:clients,id'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        return response()->json(Item::get_client_itemcategory($request->client_id));
    }

    public function get_item_fees(Request $request){
        $validator = Validator::make(
            array(
                "item_id" =>  $request->item_id
            ),
            array(
                "item_id" => 'required|exists:items,id'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }
        $item_data = Item::find($request->item_id);
        $item_data->item_fees = Item::get_item_fees($request->item_id);
        return response()->json($item_data);
    }

    public function get_item_detail(Request $request){
        $item_data = Item::get_item_detail($request->item_id);
        return response()->json($item_data);
    }

    public function item_validator(Object $request){
        $validator = Validator::make(
            array(
                "client_id"     => $request->client_id,
                "name"          => $request->name,
                "unit_name"     => $request->unit_name,
            ),
            array(
                "client_id"     => 'required|exists:clients,id',
                "name"          => 'min:3|required',
                "unit_name"     => 'min:3|required'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }
    }

    public function bongkar(Request $request){
        $bongkar_header = new Bongkar_header();
        $bongkar_header->client_id    = $request->client_id;
        $bongkar_header->droporder_id = $request->droporder_id;
        $bongkar_header->truck_number = $request->truck_number;
        $bongkar_header->delivered_at  = date("Y-m-d H:i:s", strtotime($request->delivered_at));
        $bongkar_header->save();

        foreach (json_decode($request->bongkar_footer) as $footer) {
            $bongkar_footer = new Bongkar_footer();
            $bongkar_footer->item_id = $footer->id;
            $bongkar_footer->qty = $footer->qty;
            $bongkar_footer->header_id = $bongkar_header->id;
            $bongkar_footer->note = $footer->note;
            $bongkar_footer->save();
        }
        return response()->json(Item::get_client_item($request->client_id));
    }

    public function muat(Request $request){
        $muat_header = new Muat_header();
        $muat_header->client_id    = $request->client_id;
        $muat_header->droporder_id = $request->droporder_id;
        $muat_header->truck_number = $request->truck_number;
        $muat_header->delivered_at  = date("Y-m-d H:i:s", strtotime($request->delivered_at));
        $muat_header->save();

        foreach (json_decode($request->muat_footer) as $footer) {
            $muat_footer = new Muat_footer();
            $muat_footer->item_id = $footer->id;
            $muat_footer->qty = $footer->qty;
            $muat_footer->header_id = $muat_header->id;
            $muat_footer->note = $footer->note;
            $muat_footer->save();
        }
        return response()->json(Item::get_client_item($request->client_id));
    }

    public function add_new_item(Request $request){
        $this->item_validator($request);
        $item = new Item();
        $item->category_id  = $request->category_id;
        $item->client_id    = $request->client_id;
        $item->name         = $request->name;
        $item->unit_name    = $request->unit_name;
        $item->save();
        return response()->json($item);
    }

    public function edit_item(Request $request){
        $item = Item::find($request->id);
        if (!$item) {
            return response()->json('item not found',400);
        };

        // Changing Client must also change transaction charge.
        $request->client_id = $request->client_id ? $request->client_id : $item->client_id;


        $request->name = $request->name ? $request->name : $item->name;
        $request->unit_name = $request->unit_name ? $request->unit_name : $item->unit_name;

        $this->item_validator($request);

        $item->client_id = $request->client_id;
        $item->name      = $request->name;
        $item->unit_name = $request->unit_name;
        $item->save();
        return response()->json($item);
    }

    public function itemlog_validator(Object $request){
        $validator = Validator::make(
            array(
                "item_id"     => $request->item_id,
                "fee_ref_id"  => $request->fee_ref_id,
                "qty"         => $request->qty,
            ),
            array(
                "item_id"     => 'required|exists:items,id',
                "fee_ref_id"  => 'required|exists:single_fees,id',
                "qty"         => 'required'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }
    }

    public function add_item_log(Request $request){
        $this->itemlog_validator($request);
        $fee = Single_fee::find($request->fee_ref_id);
        
        if($fee->name=="muat"){
            $request->qty = $request->qty * -1;
        };

        $itemlog = Itemlog::create([
            'item_id'    => $request->item_id,
            'fee_ref_id' => $request->fee_ref_id,
            'qty'        => $request->qty,
            'note'       => $fee->name
        ]);
        $item_data = Item::find($request->item_id);
        $item_data->detail = Item::get_item_detail($request->item_id);
        return response()->json($item_data);
    }

    public function update_item_log(Request $request){
        $itemlog = Itemlog::find($request->itemlog_id);
        if (!$itemlog) {
            return response()->json('itemlog not found',400);
        };
        $this->itemlog_validator($request);

        // Changing Client must also change transaction charge.
        $request->item_id    = $request->item_id ? $request->item_id : $itemlog->item_id;
        $request->fee_ref_id = $request->fee_ref_id ? $request->fee_ref_id : $itemlog->fee_ref_id;
        $request->qty        = $request->qty ? $request->qty : $itemlog->qty;

        $itemlog->item_id    = $request->item_id;
        $itemlog->fee_ref_id = $request->fee_ref_id;
        $itemlog->qty        = $request->qty;
        $itemlog->save();

        $item_data = Item::find($request->item_id);
        $item_data->detail = Item::get_item_detail($request->item_id);
        return response()->json($item_data);
    }

    public function delete_item_log(Request $request){
        $validator = Validator::make(
            array(
                "itemlog_id" => $request->itemlog_id
            ),
            array(
                "itemlog_id" => 'required|exists:itemlogs,id'
            )
        );

        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $itemlog = Itemlog::find($request->itemlog_id);
        $itemlog->delete();

        $item_data = Item::find($request->item_id);
        $item_data->detail = Item::get_item_detail($request->item_id);
        return response()->json($item_data);
    }
}
