@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-male"></i>&nbsp &nbsp All Active Customers</h3>
        </div>
        <hr class="mb-4">
        <form method="POST">
            {{@csrf_field()}}
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search customer by id..." name="searchCustomer">
                <input class="btn btn-primary" type="submit" value="Search">
                @error('searchCustomer')
                <span class="text text-danger">
                    {{$message}}
                </span>
                @enderror
            </div>
        </form>
        <div>
            <a href="{{route('admin.dwonloadActiveCustomer')}}" class="btn btn-info">Download</a>
        </div>
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
                @if(count($customers)>0)
                    @foreach($customers as $c)
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->user_info->name}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->user_info->gender}}</td>
                            <td>{{$c->user_info->dob}}</td>
                            <td>{{$c->user_info->contact_no}}</td>
                            <td>{{$c->user_info->present_address}}</td>
                            <td>{{$c->user_info->permanent_address}}</td>
                            <td><img src="{{asset($c->user_info->image)}}" alt="None" width="200" height="200"> </td>
                            <td>
                                <a href="{{route('admin.customer.active.changeAcssess',['id'=> encrypt($c->id)])}}" class="btn btn-warning mb-2">Change Access</a>
                            </td>
                        </tr>
                    @endforeach
                @endif    
            </tbody>
        </table>
    </div>
</div>
@endsection