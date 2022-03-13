@extends('layouts.customer')
@section('content')
    <form action="" method="post">
        <table class="table">
            @csrf 
            <tr>
                <td><input type="hidden" name="product_id" value="{{$product->id}}" ></td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; display: flex;
                justify-content:center; align-items: center;">
                    <img src="{{asset($product->image)}}" alt="product_image"
                     style='width:50%; border-radius:50%;'>
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="" disabled value="{{$product->name}}" id=""></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="" disabled value="{{$product->price}}" id=""></td>
                <td>BDT/{{$product->per_quantity}}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="" disabled id="" cols="30" rows="10">
                    {{$product->description}}
                </textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input class="btn btn-primary" type="submit" name="Submit" value=" + Add To Cart"></td>
            </tr>
        </table>
    </form>
@endsection