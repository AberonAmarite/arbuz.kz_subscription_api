<?php

use App\Http\Controllers\Api\DeliveryDetailsController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SubscriptionItemController;
use App\Models\DeliveryDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'subscriptions' => SubscriptionController::class,
    'delivery_details' => DeliveryDetailsController::class,
    'subscription_items' => SubscriptionItemController::class
]);
