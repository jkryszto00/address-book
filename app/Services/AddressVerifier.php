<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class AddressVerifier
{
    public function getDuplicatedAddresses(): Collection
    {
        return DB::table('addresses')
            ->select('number', 'street', 'city', 'zip')
            ->groupBy('number', 'street', 'city', 'zip')
            ->havingRaw('count(*) > 1')
            ->get();
    }

    public function getDuplicatedAddressModelIds(stdClass $address): Collection
    {
        $addressModels = DB::table('addresses')->where([
                ['number', $address->number],
                ['street', $address->street],
                ['city', $address->city],
                ['zip', $address->zip]
            ])
            ->orderBy('id')
            ->get();

        $addressModels->shift();
        return $addressModels->pluck('id');
    }

    public function deleteDuplicates(array $ids): void
    {
        DB::table('addresses')->whereIn('id', $ids)->delete();
    }
}
