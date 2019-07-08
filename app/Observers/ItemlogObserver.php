<?php

namespace App\Observers;

use App\Itemlog;
use App\Item;
use App\Transaction;
use App\Single_fee;

class ItemlogObserver
{
    /**
     * Handle the itemlog "created" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function created(Itemlog $itemlog)
    {
        // lets save the qty of item, for each new record from itemlog when its created.
        $item = Item::find($itemlog->item_id);
        if($itemlog->type=="addition"){
            $item->qty = $item->qty + $itemlog->qty;
        }
        elseif ($itemlog->type=="subtraction") {
            $item->qty = $item->qty - $itemlog->qty;
        }
        $item->save();
    }

    /**
     * Handle the itemlog "updating" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function updating(Itemlog $itemlog)
    {
        $itemlog_old = Itemlog::find($itemlog->id);
        $item = Item::find($itemlog_old->item_id);
        if($itemlog_old->type=="addition"){
            $item->qty = $item->qty - $itemlog->qty;
        }
        elseif ($itemlog_old->type=="subtraction") {
            $item->qty = $item->qty + $itemlog->qty;
        }
        $item->save();
    }

    /**
     * Handle the itemlog "updated" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function updated(Itemlog $itemlog)
    {
        $item = Item::find($itemlog->item_id);
        if($itemlog->type=="addition"){
            $item->qty = $item->qty + $itemlog->qty;
        }
        elseif ($itemlog->type=="subtraction") {
            $item->qty = $item->qty - $itemlog->qty;
        }
        $item->save();
    }

    /**
     * Handle the itemlog "deleted" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function deleted(Itemlog $itemlog)
    {
        // lets save the qty of item, for each new record from itemlog when its created.
        $item = Item::find($itemlog->item_id);
        if($itemlog->type=="addition"){
            $item->qty = $item->qty - $itemlog->qty;
        }
        elseif ($itemlog->type=="subtraction") {
            $item->qty = $item->qty + $itemlog->qty;
        }
        $item->save();

    }

    /**
     * Handle the itemlog "restored" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function restored(Itemlog $itemlog)
    {
        //
    }

    /**
     * Handle the itemlog "force deleted" event.
     *
     * @param  \App\Itemlog  $itemlog
     * @return void
     */
    public function forceDeleted(Itemlog $itemlog)
    {
        //
    }
}
