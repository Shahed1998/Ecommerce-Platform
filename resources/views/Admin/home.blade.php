@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
        <div class="row justify-content-center">
            <h3><i class="fas fa-thumbtack"></i> &nbsp Dashboard</h3>
        </div>
        <hr>
        <div class="container">
        <div class="row justify-content-center">
            <div class="card w-100 bg-light text-dark m-3 border border-primary">
                <div class="card-header bg-dark text-light" align="center" style="font-family: verdana"><b>Current Affairs</b></div>
                        <div class="card-body">
                        <div class="card-text" style="font-size:20px">
                        <i class="fa fa-star" aria-hidden="true"></i>&nbsp
                            Pending Customers - {{$c}}
                            <hr>
                            <i class="fa fa-star" aria-hidden="true"></i>&nbsp 
                            Pending Vendors - {{$v}}
                            <hr>
                            <i class="fa fa-star" aria-hidden="true"></i>&nbsp
                            Pending Delivery Staffs - {{$s}}
                            <hr>
                            <i class="fa fa-star" aria-hidden="true"></i>&nbsp
                            Total Pendings - {{$t}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection