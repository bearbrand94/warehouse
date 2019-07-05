<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Bongkar_header;
use App\Bongkar_footer;
use App\Muat_header;
use App\Muat_footer;

class BongkarMuat extends Model
{

    public static function get_bongkarmuat_list(){
        $bongkar = DB::table('bongkar_header')
        			->join('clients', 'clients.id', '=', 'bongkar_header.client_id')
                    ->join('bongkar_footer', 'bongkar_header.id', '=', 'bongkar_footer.header_id')
                   	->select('clients.name', 'bongkar_header.id', DB::raw('concat("TB", LPAD(bongkar_header.id, 6, "0")) as showid'), 'bongkar_header.droporder_id', 'bongkar_header.delivered_at', 'bongkar_header.truck_number', DB::raw('"bongkar" as table_name'), 'bongkar_header.updated_at', DB::raw('sum(`bongkar_footer`.`qty`) as qty'))
                    ->groupby('bongkar_header.id');

        $muat = DB::table('muat_header')
        			->join('clients', 'clients.id', '=', 'muat_header.client_id')
                    ->join('muat_footer', 'muat_header.id', '=', 'muat_footer.header_id')
                  	->select('clients.name', 'muat_header.id', DB::raw('concat("TM", LPAD(muat_header.id, 6, "0")) as showid'), 'muat_header.droporder_id', 'muat_header.delivered_at', 'muat_header.truck_number', DB::raw('"muat" as table_name'), 'muat_header.updated_at', DB::raw('sum(`muat_footer`.`qty`) as qty'))
                    ->groupby('muat_header.id')
                    ->union($bongkar)
                    ->orderby('delivered_at', "asc")
                    ->get();
        return $muat;
    }

    public static function get_bongkar_detail($bongkar_header_id){
        $bongkar_data = DB::table('bongkar_header')
                ->join('clients', 'clients.id', '=', 'bongkar_header.client_id')
                ->select('bongkar_header.*', 'clients.name as owned_by', DB::raw('concat("TB", LPAD(bongkar_header.id, 6, "0")) as showid'))
                ->where('bongkar_header.id', $bongkar_header_id)
                ->first();
        $bongkar_data->detail = DB::table('bongkar_footer')
            ->join('items', 'items.id', '=', 'bongkar_footer.item_id')
            ->select('bongkar_footer.*', 'items.name as item_name')
            ->where('bongkar_footer.header_id', $bongkar_data->id)
            ->orderBy('created_at', 'desc')->get();
        
        return $bongkar_data;
    }

    public static function get_muat_detail($muat_header_id){
        $muat_data = DB::table('muat_header')
                ->join('clients', 'clients.id', '=', 'muat_header.client_id')
                ->select('muat_header.*', 'clients.name as owned_by', DB::raw('concat("TM", LPAD(muat_header.id, 6, "0")) as showid'))
                ->where('muat_header.id', $muat_header_id)
                ->first();
        $muat_data->detail = DB::table('muat_footer')
            ->join('items', 'items.id', '=', 'muat_footer.item_id')
            ->select('muat_footer.*', 'items.name as item_name')
            ->where('muat_footer.header_id', $muat_data->id)
            ->orderBy('created_at', 'desc')->get();
        
        return $muat_data;
    }
}
