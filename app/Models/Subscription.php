<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'phone_number'];
    public function lists(){
        return $this->hasMany(SubscriptionItem::class);
    }

}
