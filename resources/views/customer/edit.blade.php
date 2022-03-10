@extends('layouts.customer')
@section('content')
    <div class="inner-content">
        <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Update infos</h5>
                <!-- <p class="card-text">Update your email and password and others</p> -->
                <a href="{{route('customer.update')}}"><button class="btn btn-primary">Update</button></a>
            </div>
        </div>
        <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Delete account</h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <a href="{{route('customer.delete')}}"><button class="btn btn-primary">Delete</button></a>
            </div>
        </div>
    </div>
@endsection
