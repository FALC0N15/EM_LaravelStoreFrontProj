<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'total_amount', 'order_notes', 'order_status', 'shipping_address', 'billing_address', 'order_quantity'])]
class Order extends Model
{
    use HasFactory;
}
