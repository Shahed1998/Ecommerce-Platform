<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredential extends Model
{
    use HasFactory;
    public $table="user_credentials";
    public $timestamps=false;
}
