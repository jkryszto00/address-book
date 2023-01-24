<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $addresses = Address::filter($request->only('number', 'street', 'city', 'zip'))->inRandomOrder()->limit(10)->get();

        return response()->json(AddressResource::collection($addresses));
    }
}
