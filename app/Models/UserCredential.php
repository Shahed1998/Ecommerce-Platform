<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserInfo;
use App\Models\UserStatus;
use App\Models\UserRole;

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
