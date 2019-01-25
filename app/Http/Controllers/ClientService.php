<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Validator;

class ClientService extends Controller
{

    public function client_validator(Object $request){
        $validator = Validator::make(
            array(
                "id"        => $request->id,
                "name"      => $request->name,
                "phone1"    => $request->phone1,
                "phone2"    => $request->phone2,
                "email"     => $request->email
            ),
            array(
                "id"      => 'required',
                "name"      => 'min:3',
                "phone1"    => 'min:3',
                "phone2"    => 'nullable',
                "email"     => 'nullable|email|unique:users,email'
            )
        );
    }
    public function add_new_client(Request $request){

        $this->client_validator($request);
        $client          = new Client();
        $client->name    = $request->name;
        $client->address = $request->address ? $request->address : "";
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2 ? $request->phone2 : "";
        $client->email   = $request->email ? $request->email : "";
        $client->save();
        return response()->json($client);
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

        $this->client_validator($request);

        $client->name    = $request->name;
        $client->address = $request->address;
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2;
        $client->email   = $request->email;
        $client->save();
        return response()->json($client);
    }
}
