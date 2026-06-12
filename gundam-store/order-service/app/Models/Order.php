<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add this block to allow mass assignment!
    protected $fillable = [
        'customer_name',
        'kit_id',
        'quantity',
        'total_price',
    ];
}