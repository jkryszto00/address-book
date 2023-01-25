<?php

namespace App\Listeners;

use App\Events\AddressCreated;
use App\Mail\AddressCreatedMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToAdminNotification
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
     * @param  \App\Events\AddressCreated  $event
     * @return void
     */
    public function handle(AddressCreated $event)
    {
        $users = User::whereRoleIs(['administrator', 'superadministrator'])->get();
        Mail::to($users)->send(new AddressCreatedMail($event->address));
    }
}
