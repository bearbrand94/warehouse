<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
use App\Bongkar_footer;
use App\Bongkar_header;
use App\Muat_footer;
use App\Muat_header;

class Item extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'name', 'unit_name', 'qty', 'created_at'
    ];

    public static function get_item_list(){
        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by', 'clients.id as client_id')
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }

    public static function get_client_itemcategory($client_id){
        $item_data = DB::table('item_category')
                ->select('*')
                ->where('client_id', $client_id)
                ->orderBy('updated_at', 'desc')->get();
        // return $item_data;

        for ($i=0; $i < count($item_data); $i++) { 
            $item_data[$i]->items = DB::table('items')
                ->select('items.name', 'items.unit_name', 'items.qty as sisa', 'itemlogs.*')
                ->join('itemlogs', 'itemlogs.item_id', 'items.id')
                ->where('items.category_id', $item_data[$i]->id)
                ->orderBy('created_at', 'asc')->get();

            $total_keluar = 0;
            $total_masuk = 0;
            foreach ($item_data[$i]->items as $item) {
                if($item->type=="subtraction"){
                    $total_keluar += $item->qty;
                }
                else if($item->type=="addition"){
                    $total_masuk += $item->qty;
                }
            }
            $item_data[$i]->total_keluar = $total_keluar;
            $item_data[$i]->total_masuk = $total_masuk;
            $item_data[$i]->total_sisa = DB::table('items')->where('items.category_id', $item_data[$i]->id)->sum('items.qty');
        }
        return $item_data;
    }

    public static function get_client_item($client_id){
        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by')
                ->where('items.client_id', $client_id)
                ->orderBy('updated_at', 'desc');
        return $item_data->get();
    }

    public static function get_item_fees($item_id){
        $single_fees = DB::table('single_fees')
                ->select('single_fees.id', 'single_fees.name', 'single_fees.price')
                ->where('single_fees.item_id', $item_id);

        $all_fees = DB::table('recurring_fees')
                ->select('recurring_fees.id', 'recurring_fees.name', 'recurring_fees.price')
                ->where('recurring_fees.item_id', $item_id)
                ->union($single_fees);

        return $single_fees->get();
    }

    public static function get_item_detail($item_id){
        $validator = Validator::make(
            array(
                "item_id"=>$item_id
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

        $item_data = DB::table('items')
                ->join('clients', 'clients.id', '=', 'items.client_id')
                ->select('items.*', 'clients.name as owned_by')
                ->where('items.id', $item_id)
                ->first();

        // $bongkar = DB::table('bongkar_footer')
        //            ->join('bongkar_header', 'bongkar_header.id', '=', 'bongkar_footer.header_id')
        //            ->select(DB::raw('concat("K", LPAD(bongkar_footer.id, 7, "0")) as id'), 'bongkar_header.droporder_id', 'bongkar_header.delivered_at', 'bongkar_footer.qty', DB::raw('"bongkar" as table_name'), 'bongkar_footer.updated_at')
        //            ->where('bongkar_footer.item_id', $item_id);

        // $muat = DB::table('muat_footer')
        //            ->join('muat_header', 'muat_header.id', '=', 'muat_footer.header_id')
        //            ->select(DB::raw('concat("M", LPAD(muat_footer.id, 7, "0")) as id'), 'muat_header.droporder_id', 'muat_header.delivered_at', 'muat_footer.qty', DB::raw('"muat" as table_name'), 'muat_footer.updated_at')
        //            ->where('muat_footer.item_id', $item_id)
        //             ->union($bongkar)
        //             ->orderby('updated_at', "asc")
        //             ->get();
        // $item_data->detail = $muat;

        $item_data->detail = DB::table('itemlogs')
            ->join('items', 'items.id', '=', 'itemlogs.item_id')
            ->select('itemlogs.*', 'items.name as item_name')
            ->where('items.id', $item_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')->get();

        $sisa = $item_data->qty;
        for ($i=0; $i < count($item_data->detail); $i++) { 
            $item_data->detail[$i]->sisa = $sisa;

            if($item_data->detail[$i]->type == "subtraction"){
                $sisa += $item_data->detail[$i]->qty;
                $footer_data = Muat_footer::find($item_data->detail[$i]->ref_id);
                $item_data->detail[$i]->header_id = $footer_data->header_id;
                $item_data->detail[$i]->droporder_id = Muat_header::find($footer_data->header_id)->droporder_id;
            }
            else{
                $sisa -= $item_data->detail[$i]->qty;
                $footer_data = Bongkar_footer::find($item_data->detail[$i]->ref_id);
                $item_data->detail[$i]->header_id = $footer_data->header_id;
                $item_data->detail[$i]->droporder_id = Bongkar_header::find($footer_data->header_id)->droporder_id;
            }        
        }
        return $item_data;
    }
}
