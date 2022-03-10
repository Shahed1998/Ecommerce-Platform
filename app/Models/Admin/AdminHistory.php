<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\UserCredential;

class AdminHistory extends Model
{
    use HasFactory;
    protected $table ="admin_history";
    public $timestamps = false;

    public function Admin_History(){
        return $this->belongsTo(UserCredential::class, 'admin_id');
    }
}
