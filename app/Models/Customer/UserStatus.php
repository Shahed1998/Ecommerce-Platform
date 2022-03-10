<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\UserCredential;

class UserStatus extends Model
{
    use HasFactory;
    protected $table = "user_status";
    public $timestamps = false;

    public function userCredential(){
        return $this->hasMany(UserCredential::class, 'user_status');
    }

}