<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $q = $request->get('q');

        if ($q) {
            $addresses = (new Search())->registerModel(Address::class, ['number', 'street', 'city', 'zip'])
                ->search($q)
                ->map(fn ($searched) => $searched->searchable);
        } else {
            $addresses = Address::inRandomOrder()->limit(10)->get();
        }

        return response()->json(AddressResource::collection($addresses));
    }
}
