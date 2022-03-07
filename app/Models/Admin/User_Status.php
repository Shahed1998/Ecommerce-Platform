<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\UserCredential;

class User_Status extends Model
{
    use HasFactory;
    public $table="user_status";
    public $timestamps=false;

    public function UserCredentials()
    {
        return $this->hasMany(UserCredential::class,'user_status');
    }
}
