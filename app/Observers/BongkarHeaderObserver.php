<?php

namespace App\Observers;

use App\Bongkar_header;
use App\Itemlog;

class BongkarHeaderObserver
{
    /**
     * Handle the bongkar_header "created" event.
     *
     * @param  \App\Bongkar_header  $bongkarHeader
     * @return void
     */
    public function created(Bongkar_header $bongkarHeader)
    {
        //
    }

    /**
     * Handle the bongkar_header "updated" event.
     *
     * @param  \App\Bongkar_header  $bongkarHeader
     * @return void
     */
    public function updated(Bongkar_header $bongkarHeader)
    {
        //
        $itemlog = Itemlog::where('ref_id', $bongkarFooter->id)->where('ref_table_name', 'Bongkar_footer')->first();
        $itemlog->item_id = $bongkarFooter->item_id;
        $itemlog->qty = $bongkarFooter->qty;
        $itemlog->note = $bongkarFooter->note ? $bongkarFooter->note : "bongkar";
        $itemlog->save();
    }

    /**
     * Handle the bongkar_header "deleted" event.
     *
     * @param  \App\Bongkar_header  $bongkarHeader
     * @return void
     */
    public function deleted(Bongkar_header $bongkarHeader)
    {
        //
    }

    /**
     * Handle the bongkar_header "restored" event.
     *
     * @param  \App\Bongkar_header  $bongkarHeader
     * @return void
     */
    public function restored(Bongkar_header $bongkarHeader)
    {
        //
    }

    /**
     * Handle the bongkar_header "force deleted" event.
     *
     * @param  \App\Bongkar_header  $bongkarHeader
     * @return void
     */
    public function forceDeleted(Bongkar_header $bongkarHeader)
    {
        //
    }
}
