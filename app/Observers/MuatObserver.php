<?php

namespace App\Observers;

use App\Muat_footer;
use App\Muat_header;
use App\Item;
use App\Itemlog;
class MuatObserver
{
    /**
     * Handle the muat_footer "created" event.
     *
     * @param  \App\Muat_footer  $muatFooter
     * @return void
     */
    public function created(Muat_footer $muatFooter)
    {
        // $item = Item::find($muatFooter->item_id);
        // $item->qty = $item->qty - $muatFooter->qty;
        // $item->save();

        $itemlog = Itemlog::create([
            'item_id' => $muatFooter->item_id,
            'ref_table_name' => "Muat_footer",
            'ref_id' => $muatFooter->id,
            'qty' => $muatFooter->qty,
            'note' => "muat",
            'type' => "subtraction",
            'created_at' => Muat_header::find($muatFooter->header_id)->delivered_at
        ]);
    }

    /**
     * Handle the muat_footer "updated" event.
     *
     * @param  \App\Muat_footer  $muatFooter
     * @return void
     */
    public function updated(Muat_footer $muatFooter)
    {

        $itemlog = Itemlog::where('ref_id', $muatFooter->id)->where('ref_table_name', 'Muat_footer')->first();
        $itemlog->item_id = $muatFooter->item_id;
        $itemlog->qty = $muatFooter->qty;
        $itemlog->save();
    }

    /**
     * Handle the muat_footer "deleted" event.
     *
     * @param  \App\Muat_footer  $muatFooter
     * @return void
     */
    public function deleting(Muat_footer $muatFooter)
    {
        Itemlog::where('ref_id', $muatFooter->id)->where('ref_table_name', 'Muat_footer')->first()->delete();
    }

    /**
     * Handle the muat_footer "restored" event.
     *
     * @param  \App\Muat_footer  $muatFooter
     * @return void
     */
    public function restored(Muat_footer $muatFooter)
    {
        //
    }

    /**
     * Handle the muat_footer "force deleted" event.
     *
     * @param  \App\Muat_footer  $muatFooter
     * @return void
     */
    public function forceDeleted(Muat_footer $muatFooter)
    {
        //
    }
}
