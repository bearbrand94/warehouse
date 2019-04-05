<?php

namespace App\Observers;

use App\Muat_header;

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
        //
    }

    /**
     * Handle the muat_header "deleted" event.
     *
     * @param  \App\Muat_header  $muatHeader
     * @return void
     */
    public function deleted(Muat_header $muatHeader)
    {
        //
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
