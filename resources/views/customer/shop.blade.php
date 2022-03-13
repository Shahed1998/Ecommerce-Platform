@extends('layouts.customer')
@section('content')
    <div class="row">
        @foreach($products as $product)
            <div class="col-sm-4 mt-4">
            <div class="card">
            <img src="{{asset($product->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ucfirst($product->name)}}</h5>
                <p class="card-text">{{substr($product->description,0,50)}}...</p>
                <a href="{{route('customer.product.view.one',['id'=>encrypt($product->id)])}}" class="btn btn-primary">View details</a>
            </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
