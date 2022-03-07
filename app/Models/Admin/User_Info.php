<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\UserCredential;

class User_Info extends Model
{
    use HasFactory;
    public $table="user_info";
    public $timestamps=false;

    public function UserCredential()
    {
        return $this->belongsTo(UserCredential::class,'uc_id');
    }
}
