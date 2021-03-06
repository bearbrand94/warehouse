<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\BongkarMuat;
use App\Bongkar_footer;
use App\Muat_footer;
use App\Muat_header;
use Validator;

class BongkarMuatService extends Controller
{

    public function get_bongkarmuat_header(Request $request){
        return response()->json(BongkarMuat::get_bongkarmuat_list());
    }

    public function bongkarmuat_validator(Object $request){
        $validator = Validator::make(
            array(
                "item_id"   => $request->item_id,
                "qty"       => $request->qty,
                "note"      => $request->note,
            ),
            array(
                "item_id"   => 'required|exists:items,id',
                "qty"       => 'numeric|min:1',
                "note"      => 'nullable',
            )
        );
        return $validator;
    }

    public function bongkarmuat_header_validator(Object $request){
        $validator = Validator::make(
            array(
                "droporder_id"   => $request->droporder_id,
                "truck_number"   => $request->truck_number,
                "delivered_at"   => $request->delivered_at,
            ),
            array(
                "droporder_id"   => 'nullable',
                "truck_number"   => 'required|min:1',
                "delivered_at"   => 'required',
            )
        );
        return $validator;
    }

    public function edit_muat_header(Request $request){
        $muat_data = Muat_header::find($request->id);
        if (!$muat_data) {
            return response()->json('id not found',400);
        };

        $muat_data->droporder_id = $request->droporder_id ? $request->droporder_id : $muat_data->droporder_id;
        $muat_data->truck_number = $request->truck_number ? $request->truck_number : $muat_data->truck_number;
        $muat_data->delivered_at  = $request->delivered_at ? date("Y-m-d H:i:s", strtotime($request->delivered_at)) : $muat_data->delivered_at;

        $validator = $this->bongkarmuat_header_validator($muat_data);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $muat_data->save();
        return response()->json('Muat Header Berhasil Diubah');
    }

    public function edit_muat_footer(Request $request){
        $muat_data = Muat_footer::find($request->id);
        if (!$muat_data) {
            return response()->json('id not found',400);
        };

        $muat_data->item_id = $request->item_id ? $request->item_id : $muat_data->item_id;
        $muat_data->qty = $request->qty ? $request->qty : $muat_data->qty;
        $muat_data->note  = $request->note ? $request->note : $muat_data->note;

        $validator = $this->bongkarmuat_validator($muat_data);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $muat_data->save();
        return response()->json('Muat Berhasil Diubah');
    }

    public function edit_muat(Request $request){
        $muat_header = 
        $muat_data = Muat_footer::find($request->id);
        if (!$muat_data) {
            return response()->json('id not found',400);
        };

        $muat_data->item_id = $request->item_id ? $request->item_id : $muat_data->item_id;
        $muat_data->qty = $request->qty ? $request->qty : $muat_data->qty;
        $muat_data->note  = $request->note ? $request->note : $muat_data->note;

        $validator = $this->bongkarmuat_validator($muat_data);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $muat_data->save();
        return response()->json('Muat Berhasil Diubah');
    }

    public function delete_muat(Request $request){
        $muat_data = Muat_footer::find($request->id);
        if (!$muat_data) {
            return response()->json('id not found',400);
        };

        $deletedRows = $muat_data->delete();
        return response()->json('Muat Berhasil Dihapus');
    }

    public function edit_bongkar(Request $request){
        $bongkar_data = Bongkar_footer::find($request->id);
        if (!$bongkar_data) {
            return response()->json('id not found',400);
        };

        $bongkar_data->item_id = $request->item_id ? $request->item_id : $bongkar_data->item_id;
        $bongkar_data->qty = $request->qty ? $request->qty : $bongkar_data->qty;
        $bongkar_data->note  = $request->note ? $request->note : $bongkar_data->note;

        $validator = $this->bongkarmuat_validator($bongkar_data);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $bongkar_data->save();
        return response()->json('Bongkar Berhasil Diubah');
    }

    public function delete_bongkar(Request $request){
        $bongkar_data = Bongkar_footer::find($request->id);
        if (!$bongkar_data) {
            return response()->json('id not found',400);
        };

        $deletedRows = $bongkar_data->delete();
        return response()->json('Bongkar Berhasil Dihapus');
    }
}
