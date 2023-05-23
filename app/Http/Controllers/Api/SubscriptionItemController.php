<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionItemStoreRequest;
use App\Http\Resources\SubscriptionItemResouce;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscriptionItemResouce::collection(Subscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionItemStoreRequest $request)
    {
        $created_subscription = Subscription::create($request->validated());

        return new SubscriptionItemResouce($created_subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionItem $subscriptionItem)
    {
        return new SubscriptionItemResouce($subscriptionItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionItemStoreRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return new SubscriptionItemResouce($subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
