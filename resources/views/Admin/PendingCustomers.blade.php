@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-male"></i>&nbsp &nbsp All Pending Customers</h3>
        </div>
        <hr class="mb-4">
        <form method="POST">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search customer by id..." name="searchCustomer">
                <input class="btn btn-primary" type="submit" value="Search">
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
                    <th>Present Address</th>
                    <th>Permanent Address</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody id="dynamic-row">    
                @foreach($productList as $product)
                    @if($product['product_condition'] == "Good")
                    <tr>
                            <td>{{$product['product_id']}}</td>
                            <td>{{$product['product_name']}}</td>
                            <td>
                                {{$product['status_sell']}}
                                <br>
                                {{$product['status_purchase']}}
                            </td>
                            <td>{{$product['nature']}}</td>
                            <td>{{$product['selling_price']}}</td>
                            <td>{{$product['product_description']}}</td>
                            <td>
                            <img src="/upload/Product/{{$product['image']}}" alt="Potato" width="200" height="200"> 
                            </td>
                            <td>{{$product['product_condition']}}</td>
                            <td>
                            <a href="/product/edit/{{$product['id']}}" class="btn btn-warning mb-2">Update</a>
                            <a href="/product/delete/{{$product['id']}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>       
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection