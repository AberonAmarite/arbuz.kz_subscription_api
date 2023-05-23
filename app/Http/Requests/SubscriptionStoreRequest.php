<?php

namespace App\Http\Requests;

use App\Rules\SufficientInventory;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date'=>'required',
            'end_date'=>'required',
            'phone_number'=>'required',
            'user_id' => 'required',

            'order_items' => 'required|array',
            'order_items.*' => ['required', 'array', new SufficientInventory],
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => ['required', 'integer', 'min:1'],

            'delivery_details' => 'required',
            'delivery_details.day_name' => 'required|string',
            'delivery_details.time_start' => 'required',
            'delivery_details.time_end' => 'required',
            'delivery_details.address' => 'required|string',
        ];
    }


}
