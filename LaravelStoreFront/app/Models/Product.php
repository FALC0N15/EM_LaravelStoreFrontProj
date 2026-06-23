<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['product_name', 'product_description', 'product_price', 'stock_quantity', 'category_id'])]
class Product extends Model
{
    use HasFactory;
}
