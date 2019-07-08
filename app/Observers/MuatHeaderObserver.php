<?php

namespace App\Observers;

use App\Muat_header;
use App\Muat_footer;
use App\Itemlog;

class MuatHeaderObserver
{
    /**
     * Handle the muat_header "created" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function created(Muat_header $muatHeader)
    {
        //
    }

    /**
     * Handle the muat_header "updated" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function updated(Muat_header $muatHeader)
    {
        $itemlog = Itemlog::join('Muat_footer', "Muat_footer.id", "=", "Itemlogs.ref_id")
                    ->where('ref_table_name', 'Muat_footer')
                    ->where('Muat_footer.header_id', $muatHeader->id)
                    ->get();
        foreach ($itemlog as $log) {
            $cntlog = Itemlog::find($log->id);
            $cntlog->created_at = $muatHeader->delivered_at;
            $cntlog->save();
        }
    }

    /**
     * Handle the muat_header "deleted" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function deleted(Muat_header $muatHeader)
    {
        $muatFooter = Muat_footer::where('header_id', $muatHeader->id);
        foreach ($footer_data as $foot) {
            $footer = Muat_footer::find($foot->id);
            $footer->delete();
        }
    }

    /**
     * Handle the muat_header "restored" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function restored(Muat_header $muatHeader)
    {
        //
    }

    /**
     * Handle the muat_header "force deleted" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function forceDeleted(Muat_header $muatHeader)
    {
        //
    }
}
