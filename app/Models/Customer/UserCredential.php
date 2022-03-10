<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\UserInfo;
use App\Models\Customer\UserStatus;
use App\Models\Customer\UserRole;

class UserCredential extends Model
{
    use HasFactory;
    protected $table = "user_credentials";
    public $timestamps = false;

    public function userInfo(){
        return $this->hasOne(UserInfo::class, 'uc_id');
    }

    public function userStatus(){
        return $this->belongsTo(UserStatus::class, 'user_status');
    }

    public function userRole(){
        return $this->belongsTo(UserRole::class, 'user_role');
    }
}
