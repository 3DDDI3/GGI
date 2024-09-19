<?php

namespace App\Listeners;

use App\Events\AdminHideEvent;


class AdminHideListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AdminHideEvent $event)
    {
    }
}
