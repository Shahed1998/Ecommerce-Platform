<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class Order extends Model
{
    use HasFactory;
    public $table="orders";
    public $timestamps=false;

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
