<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserCredential;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = "user_info";
    public $timestamps = false;

    public function userCredential(){
        return $this->belongsTo(UserCredential::class, 'uc_id');
    }
}
