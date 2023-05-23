<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetails extends Model
{
    protected $fillable = ['day_name', 'address', 'time_start', 'time_end'];


    use HasFactory;
}
