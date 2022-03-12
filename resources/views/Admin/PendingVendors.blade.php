@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-male"></i>&nbsp &nbsp All Pending Vendors</h3>
        </div>
        <hr class="mb-4">
        <form method="POST">
            {{@csrf_field()}}
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search vendor by id..." name="searchVendor">
                <input class="btn btn-primary" type="submit" value="Search">
                @error('searchVendor')
                <span class="text text-danger">
                    {{$message}}
                </span>
                @enderror
            </div>
        </form>
        <br>
        <div class="row align-items-start mb-2">
            <div class="col">
            </div>
            <div class="col-10"> 
            </div>
        </div>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($Vendors)>0)
                    @foreach($Vendors as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->user_info->name}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->user_info->gender}}</td>
                            <td>{{$v->user_info->dob}}</td>
                            <td>{{$v->user_info->contact_no}}</td>
                            <td>{{$v->user_info->present_address}}</td>
                            <td>{{$v->user_info->permanent_address}}</td>
                            <td><img src="{{asset($v->user_info->image)}}" alt="None" width="200" height="200"> </td>
                            <td>
                                <a href="{{route('admin.Vendor.pending.changeAcssess',['id'=> encrypt($v->id)])}}" class="btn btn-warning mb-2">Change Access</a>
                            </td>
                        </tr>
                    @endforeach
                @endif    
            </tbody>
        </table>
    </div>
</div>
@endsection