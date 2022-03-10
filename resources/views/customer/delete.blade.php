@extends('layouts.customer')
@section('content')
    <div class="inner-content">
        <p>To delete the account you have to verify user using password</p><br>
         @if(Session::has('invalid'))
            <span style="color:#fff; background-color:red; width:100%;
            margin-bottom:5px; display:block;">
                {{Session::get('invalid')}}
            </span> 
        @endif
        <form action="" method="post">
            @csrf
            {{method_field('Delete')}}
            <input type="password" name="password" id="" >
            <input type="submit" value="Delete" class="btn btn-danger">
            @error('password')
                <span style="color:red;">
                    {{$message}}
                </span>
            @enderror
        </form>
        <a href="{{route('customerEdit')}}">
                <button class="btn btn-primary">Go back</button>
        </a>
    </div>
@endsection