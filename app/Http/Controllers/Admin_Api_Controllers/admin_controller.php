<?php

namespace App\Http\Controllers\Admin_Api_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class admin_controller extends Controller
{
    //
    public function test()
    {
        return response()->json(["msg"=>"Error updating"]);
    }
}
