<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryDetailsRequest;
use App\Http\Resources\DeliveryDetailsResource;
use App\Models\DeliveryDetails;
use Illuminate\Http\Response;

class DeliveryDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeliveryDetailsResource::collection(DeliveryDetails::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryDetailsRequest $request)
    {
        $created_delivery_details = DeliveryDetails::create($request->validated());

        return new DeliveryDetailsResource($created_delivery_details);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryDetails $deliveryDetails)
    {
        return new DeliveryDetailsResource($deliveryDetails);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryDetailsRequest $request, DeliveryDetails $deliveryDetails)
    {
        $deliveryDetails->update($request->validated());

        return new DeliveryDetailsResource($deliveryDetails);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryDetails $deliveryDetails)
    {
        $deliveryDetails -> delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
