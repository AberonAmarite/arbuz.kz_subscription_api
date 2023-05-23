<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionItemStoreRequest;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Resources\SubscriptionResouce;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscriptionResouce::collection(Subscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionStoreRequest $request)
    {
        //dump($request->all());
        $created_subscription = Subscription::create($request->validated());

        return new SubscriptionResouce($created_subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResouce($subscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionStoreRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return new SubscriptionResouce($subscription);
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
