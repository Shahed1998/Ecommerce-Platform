@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-user-edit"></i>&nbsp &nbsp Blocked Vendors Access Change</h3>
        </div>
        <hr class="mb-4">
        <div class="row align-items-start mb-2">
            <div class="col">
            </div>
            <div class="col-10"> 
            </div>
        </div>
        @if($Vendor)
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gmail</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Contact No</th>
                    <th>Present Address</th>
                    <th>Permanent Address</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$Vendor->id}}</td>
                    <td>{{$Vendor->user_info->name}}</td>
                    <td>{{$Vendor->email}}</td>
                    <td>{{$Vendor->user_info->gender}}</td>
                    <td>{{$Vendor->user_info->dob}}</td>
                    <td>{{$Vendor->user_info->contact_no}}</td>
                    <td>{{$Vendor->user_info->present_address}}</td>
                    <td>{{$Vendor->user_info->permanent_address}}</td>
                    <td><img src="#" alt="Potato" width="200" height="200"> </td>
                </tr> 
            </tbody>
        </table>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <form method="POST">
                    {{@csrf_field()}}
                    <input type="submit" value="Activate" name="active"  class="btn btn-success">
                    @if(Session::get('msg1'))
                        <span class="text text-success">{{Session::get('msg1')}}<span>
                    @endif
                    @if(Session::get('msg2'))
                        <span class="text text-danger">{{Session::get('msg2')}}<span>
                    @endif
                </form> 
            </div>
        </div>
        @else
            <div class="container">
                <h3 class="row justify-content-center text text-danger">
                    No user found!
                </h3>
            </div>
        @endif
    </div>
</div>
@endsection