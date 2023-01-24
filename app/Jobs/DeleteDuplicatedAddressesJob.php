<?php

namespace App\Jobs;

use App\Services\AddressVerifier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteDuplicatedAddressesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AddressVerifier $addressVerifier)
    {
        $duplicatedAddresses = $addressVerifier->getDuplicatedAddresses();

        foreach ($duplicatedAddresses as $address) {
            dispatch(new DeleteDuplicatedAddressJob($address));
        }
    }
}
