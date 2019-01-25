<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;
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

    public function get_item_detail(Request $request){
        $validator = Validator::make(
            array(
                "item_id"=>$request->item_id
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

        return response()->json(Item::get_item_detail($request->item_id));
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

    public function add_new_item(Request $request){
        $this->item_validator($request);
        $item = new Item();
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

        $item->client_id    = $request->client_id;
        $item->name  = $request->name;
        $item->unit_name = $request->unit_name;
        $item->save();
        return response()->json($item);
    }
}
