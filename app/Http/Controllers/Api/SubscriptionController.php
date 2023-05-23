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

        // Create delivery details
        $deliveryDetails = DeliveryDetails::create($validatedData['delivery_details']);
        $deliveryDetails->save();
        // Create subscription
        $createdSubscription = Subscription::create($validatedData);

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

        // Update delivery details
        $subscription->deliveryDetails()->update($validatedData['delivery_details']);

        // Update subscription
        $subscription->update($validatedData);

        // Update subscription items
        if (isset($validatedData['order_items']) && is_array($validatedData['order_items'])) {
            $subscription->subscriptionItems()->delete();

            foreach ($validatedData['order_items'] as $orderItemData) {
                $orderItem = $subscription->subscriptionItems()->find($orderItemData['id']);

                if ($orderItem) {
                    $orderItem->update([
                        'product_id' => $orderItemData['product_id'],
                        'quantity' => $orderItemData['quantity'],
                    ]);
                }
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
