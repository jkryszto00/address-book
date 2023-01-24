<?php

namespace App\Console\Commands;

use App\Jobs\DeleteDuplicatedAddressesJob;
use Illuminate\Console\Command;

class DeleteDuplicatesAddressCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address:remove-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes duplicates from addresses table.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new DeleteDuplicatedAddressesJob());

        return Command::SUCCESS;
    }
}
