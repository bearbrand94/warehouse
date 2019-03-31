<?php

namespace App\Observers;

use App\Bongkar_footer;
use App\Bongkar_header;
use App\Item;
use App\Itemlog;

class BongkarObserver
{
    /**
     * Handle the bongkar_footer "created" event.
     *
     * @param  \App\Bongkar_footer  $bongkarFooter
     * @return void
     */
    public function created(Bongkar_footer $bongkarFooter)
    {
        // $item = Item::find($bongkarFooter->item_id);
        // $item->qty = $item->qty + $bongkarFooter->qty;
        // $item->save();

        $itemlog = Itemlog::create([
            'item_id' => $bongkarFooter->item_id,
            'ref_table_name' => "Bongkar_footer",
            'ref_id' => $bongkarFooter->id,
            'qty' => $bongkarFooter->qty,
            'note' => "bongkar",
            'type' => "addition",
            'created_at' => Bongkar_header::find($bongkarFooter->header_id)->delivered_at
        ]);

    }

    /**
     * Handle the bongkar_footer "updated" event.
     *
     * @param  \App\Bongkar_footer  $bongkarFooter
     * @return void
     */
    public function updated(Bongkar_footer $bongkarFooter)
    {
        $itemlog = Itemlog::where('ref_id', $bongkarFooter->id)->where('ref_table_name', 'Bongkar_footer')->first();
        $itemlog->item_id = $bongkarFooter->item_id;
        $itemlog->qty = $bongkarFooter->qty;
        $itemlog->note = $bongkarFooter->note ? $bongkarFooter->note : "bongkar";
        $itemlog->save();
    }

    /**
     * Handle the bongkar_footer "deleted" event.
     *
     * @param  \App\Bongkar_footer  $bongkarFooter
     * @return void
     */
    public function deleted(Bongkar_footer $bongkarFooter)
    {
        $itemlog = Itemlog::where('ref_id', $bongkarFooter->id)->where('ref_table_name', 'Bongkar_footer')->first();
        $itemlog->delete();
    }

    /**
     * Handle the bongkar_footer "restored" event.
     *
     * @param  \App\Bongkar_footer  $bongkarFooter
     * @return void
     */
    public function restored(Bongkar_footer $bongkarFooter)
    {
        //
    }

    /**
     * Handle the bongkar_footer "force deleted" event.
     *
     * @param  \App\Bongkar_footer  $bongkarFooter
     * @return void
     */
    public function forceDeleted(Bongkar_footer $bongkarFooter)
    {
        //
    }
}
