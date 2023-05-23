<?php

namespace App\Rules;

use App\Models\ProductInventory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientInventory implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

            $productId = $value['product_id'];
            $quantity = $value['quantity'];

            // Perform validation logic for each order item
            // You can access the product by its ID and check if the inventory is sufficient

            // Example validation logic:
            $product = ProductInventory::find($productId);
            if(!$product){
                $fail('No such product in inventory.');
            }
            if($product->quantity < $quantity){
                $fail('The selected product does not have sufficient inventory.');
            }


    }

}
