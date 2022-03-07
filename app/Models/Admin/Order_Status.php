<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Status extends Model
{
    use HasFactory;
    public $table="order_status";
    public $timestamps=false;
}
