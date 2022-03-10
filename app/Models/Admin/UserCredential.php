<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\User_Status;
use App\Models\Admin\User;
use App\Models\Admin\User_Info;
use App\Models\Admin\AdminHistory;

class UserCredential extends Model
{
    use HasFactory;
    public $table="user_credentials";
    public $timestamps=false;

    public function user_status()
    {
        return $this->belongsTo(User_Status::class,'user_status');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_role');
    }

    public function user_info()
    {
        return $this->hasOne(User_Info::class,'uc_id');
    }

    public function Histories(){
        return $this->hasMany(AdminHistory::class, 'admin_id');
    }
}
