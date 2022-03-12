<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order;

class Product extends Model
{
    use HasFactory;
    public $table="products";
    public $timestamps=false;

    public function Orders()
    {
        return $this->hasMany(Order::class,'product_id');
    }
}
