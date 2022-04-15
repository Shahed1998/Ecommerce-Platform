<?php

namespace App\Http\Controllers\Admin_Api_Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function MailSend()
    {
        $subject="Testing Mail";
        $body="This is a testing mail";
        Mail::to('tanvir.ahmed@aiub.edu')->send(new SendMail($subject,$body));
        return "Here";
    }
}
