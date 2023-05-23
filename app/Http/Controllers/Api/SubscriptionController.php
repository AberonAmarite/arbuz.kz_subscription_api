<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\DeliveryDetails;
use App\Models\Subscription;
use App\Models\SubscriptionItem;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscriptionResource::collection(Subscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionStoreRequest $request)
    {
        $validatedData = $request->validated();
        $createdSubscription = Subscription::create($validatedData);

        // Create delivery details
        $deliveryDetails = new DeliveryDetails([
            'day_name'=>$validatedData['delivery_details']['day_name'],
            'time_start'=>$validatedData['delivery_details']['time_start'],
            'time_end'=>$validatedData['delivery_details']['time_end'],
            'address'=>$validatedData['delivery_details']['address'],
            'subscription_id'=>$createdSubscription->id,
        ]);
        $deliveryDetails->save();
        // Create subscription

        // Create subscription items
        foreach ($validatedData['order_items'] as $orderItemData) {
            $orderItem = new SubscriptionItem([
                'product_id' => $orderItemData['product_id'],
                'quantity' => $orderItemData['quantity'],
                'subscription_id' => $createdSubscription->id
            ]);
            $orderItem->save();
        }

        return new SubscriptionResource($createdSubscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionStoreRequest $request, Subscription $subscription)
    {
        $validatedData = $request->validated();

        $deliveryDetailsData = $validatedData['delivery_details'];

        $subscription->deliveryDetails()->update($deliveryDetailsData);

        // Update subscription
        $subscription->update($validatedData);

        if (isset($validatedData['order_items']) && is_array($validatedData['order_items'])) {
            $subscription->subscriptionItems()->delete();

            foreach ($validatedData['order_items'] as $orderItemData) {
                $orderItem = new SubscriptionItem([
                    'product_id' => $orderItemData['product_id'],
                    'quantity' => $orderItemData['quantity'],
                    'subscription_id' => $subscription->id
                ]);
                $subscription->subscriptionItems()->save($orderItem);
            }
        }

        return new SubscriptionResource($subscription);
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
