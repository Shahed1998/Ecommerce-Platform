<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    use HasFactory;
    protected $table = "customer_cart";
    public $timestamps = false;

    
}
