@extends('layouts.AdminLayouts.layout')
@section('content')
<div class="col-12 col-lg-9 border border-dark rounded p-3">
    <div class="container">
        <div class="row justify-content-center">
            <h3><i class="fas fa-edit"></i> Admin Registration</h3>
        </div>
    </div>
    <hr class="mb-4">
    <div class="container">
        <div class="text-left">
            <form method="POST" enctype="multipart/form-data">
                {{@csrf_field()}}
                <table class="table table-striped table-bordered">
                    <tr>
                        <td >Name: </td>
                        <td>
                            <input type="text" value="{{old('name')}}" class="form-control" name="name">
                        </td>
                        <td>
                            <span class="text text-danger">
                                @error("name")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Email: </td>
                        <td > 
                            <input type="text" value="{{old('email')}}" class="form-control" name="email">
                        </td>
                        <td>
                            <span class="text text-danger">
                                @error("email")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td> 
                            <input type="password" value="{{old('password')}}" class="form-control" name="password"> 
                        </td>
                        <td>
                            <span class="text text-danger">
                                @error("password")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Confirm password: </td>
                        <td > <input type="password" value="{{old('confPassword')}}" class="form-control" name="confPassword"> </td>
                        <td>
                            <span class="text text-danger">
                                @error("confPassword")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Gender: </td>
                        <td> 
                            @if(old('gender')=='Male')
                                <input type="radio" value="Male"  name="gender" checked> 
                            @else
                                <input type="radio" value="Male"  name="gender">
                            @endif 
                            <label for="gender">Male</label><br>
                            @if(old('gender')=='Female')
                                <input type="radio" value="Female"  name="gender" checked> 
                            @else
                                <input type="radio" value="Female"  name="gender">
                            @endif
                            <label for="gender">Female</label>
                        </td>
                        <td>
                            <span class="text text-danger">
                                @error("gender")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Date of Birth: </td>
                        <td > <input type="date" value
                        ="{{date('Y-m-d')}}" class="form-control" name="dob"> </td>
                    </tr>
                    <tr>
                        <td>Contact number:</td>
                        <td>
                            <select name="country_code">
                                <option value="+880" selected>+880</option>
                            </select>
                            <input type="text"  name="contact" value="{{old('contact')}}" size="15">
                        </td>
                        <td>
                            <span class="text text-danger">
                                @error("contact")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Present address: </td>
                        <td > <textarea name="Praddress" id="" cols="30" rows="2" class="form-control">{{old('Praddress')}}</textarea> </td>
                        <td>
                            <span class="text text-danger">
                                @error("Praddress")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Permanent address: </td>
                        <td > <textarea name="Peaddress" id="" cols="30" rows="2" class="form-control">{{old('Peaddress')}}</textarea> </td>
                        <td>
                            <span class="text text-danger">
                                @error("Peaddress")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td >Upload image: </td>
                        <td > <input type="file" class="form-control" name="admin_image">
                        <td>
                            <span class="text text-danger">
                                @error("admin_image")
                                    {{$message}}
                                @enderror
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' align='center'>
                        <input type="submit" value="&#10003; &nbsp Register" class="btn btn-success" style="width:400px">
                        </td>
                        @if(Session::get('msg1'))
                        <td>
                            <span class="text text-success">{{Session::get('msg1')}}</span>
                        </td>
                        @endif
                        @if(Session::get('msg'))
                        <td>
                            <span class="text text-danger">{{Session::get('msg')}}</span>
                        </td>
                        @endif
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
