<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Client extends Model
{
	use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'address', 'email', 'phone1', 'phone2',
    ];

    public static function get_client_list(){
        $client_data = DB::table('clients')
                ->select('clients.*')
                ->orderBy('name', 'asc');
        return $client_data->get();
    }
}
