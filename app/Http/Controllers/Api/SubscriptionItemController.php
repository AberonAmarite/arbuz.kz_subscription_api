<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionItemStoreRequest;
use App\Http\Resources\SubscriptionItemResource;
use App\Models\Subscription;
use App\Models\SubscriptionItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscriptionItemResource::collection(Subscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionItemStoreRequest $request)
    {
        $created_subscription = Subscription::create($request->validated());

        return new SubscriptionItemResource($created_subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionItem $subscriptionItem)
    {
        return new SubscriptionItemResource($subscriptionItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionItemStoreRequest $request, SubscriptionItem $subscriptionItem)
    {
        $subscriptionItem->update($request->validated());

        return new SubscriptionItemResource($subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionItem $subscriptionItem)
    {
        $subscriptionItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
