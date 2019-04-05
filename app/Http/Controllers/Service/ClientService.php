<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Client;
use Validator;

class ClientService extends Controller
{

    public function client_validator(Object $request){
        $validator = Validator::make(
            array(
                "name"      => $request->name,
                "address"   => $request->address,
                "phone1"    => $request->phone1,
                "phone2"    => $request->phone2,
                "email"     => $request->email
            ),
            array(
                "name"      => 'min:3',
                "address"   => 'nullable|min:5',
                "phone1"    => 'min:3',
                "phone2"    => 'nullable',
                "email"     => 'nullable|email|unique:clients,email,'.$request->id
            )
        );
        return $validator;
    }

    public function get_client(Request $request){
        return response()->json(Client::get_client_list());
    }

    public function add_new_client(Request $request){
        $validator = $this->client_validator($request);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }
        $client          = new Client();
        $client->name    = $request->name;
        $client->address = $request->address ? $request->address : "";
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2 ? $request->phone2 : "";
        $client->email   = $request->email ? $request->email : "";
        $client->save();
        return response()->json('Client Berhasil Ditambahkan');
    }

    public function edit_client(Request $request){
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json('user not found',400);
        };

        $request->name = $request->name ? $request->name : $client->name;
        $request->address = $request->address ? $request->address : $client->address;
        $request->phone1  = $request->phone1 ? $request->phone1 : $client->phone1;
        $request->phone2  = $request->phone2 ? $request->phone2 : $client->phone2;
        $request->email   = $request->email ? $request->email : $client->email;

        $validator = $this->client_validator($request);
        if ($validator->fails()){
            $messages = $validator->messages();
            // return $messages;
            foreach ($messages->all() as $key => $value) {
                return $value;
            }
        }

        $client->name    = $request->name;
        $client->address = $request->address;
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2;
        $client->email   = $request->email;
        $client->save();
        return response()->json('Client Berhasil Diubah');
    }

    public function delete_client(Request $request){
        $client = Client::find($request->id);
        if (!$client) {
            return response()->json('client tidak ditemukan',400);
        };

        $deletedRows = $client->delete();
        return response()->json('Client Berhasil Dihapus');
    }
}
