<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AdminHistory;
use App\Models\Admin\UserCredential;
use App\Models\Admin\User_Info;
use PDF;


class PDFController extends Controller
{
    //
    public function __construct(){
        $this->middleware('sessionChecker');
    }
    public function generatePDFCustomer()
    {
        $customers=UserCredential::where('user_status',1)
        ->where('user_role',1)->get();
        $data = [
            'customers' => $customers
        ];
        $pdf = PDF::loadView('admin.myPDF', $data);
     
        return $pdf->download('activeCustomers.pdf');
    }
}
