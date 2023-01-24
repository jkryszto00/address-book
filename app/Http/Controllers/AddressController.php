<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Mail\AddressAdded;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasRole('administrator')) {
            $addresses = Address::all();
        } else {
            $addresses = $user->addresses;
        }

        return response()->json(AddressResource::collection($addresses));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     * @return JsonResponse
     */
    public function store(AddressRequest $request): JsonResponse
    {
        $address = Address::create([...$request->validated(), 'user_id' => $request->user()->id]);

        foreach (User::all() as $recipient) {
            Mail::to($recipient)->send(new AddressAdded());
        }

        return response()->json(new AddressResource($address));
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function show(Address $address): JsonResponse
    {
        return response()->json(new AddressResource($address));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddressRequest $request
     * @param Address $address
     * @return JsonResponse
     */
    public function update(AddressRequest $request, Address $address): JsonResponse
    {
        $address->update($request->validated());

        return response()->json(new AddressResource($address));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return Response
     */
    public function destroy(Address $address): Response
    {
        $address->delete();

        return response()->noContent();
    }
}
