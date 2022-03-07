@extends('layouts.home')
@section('content')
    <div id="registration_status_message">
        <span style="color:red">
            {{Session::get('registration_status')}}
        </span>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <table>
            <tr>
                <td>Register as:</td>
                <td>
                    <select name="register_as" id="">
                        <option value="1" selected>Customer</option>
                        <option value="3">Delivery stuff</option>
                        <option value="4">Vendor</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="uname" id="" value="{{old('uname')}}"></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("uname")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" id="" value="{{old('email')}}"></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("email")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id="" value="{{old('password')}}"></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("password")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><input type="password" name="c_password" id="" value="{{old('c_password')}}"></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("c_password")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" id="">

                        <option value="" disabled selected>Select the option below</option>

                        @if(old('gender') == "Male") <option value="Male" selected>Male</option>
                        @else <option value="Male">Male</option>
                        @endif

                        @if(old('gender') == "Female") <option value="Female" selected>Female</option>
                        @else <option value="Female">Female</option>
                        @endif
                        
                        @if(old('gender') == "Others") <option value="Others" selected>Others</option>
                        @else <option value="Others">Others</option>
                        @endif

                    </select>
                </td>
                <td>
                    <span class="err" style="color:red;">
                        @error("gender")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td><input type="date" name="dob" id="" value="{{date('Y-m-d')}}"></td>
            </tr>
            <tr>
                <td>Contact number:</td>
                <td>
                    <select name="country_code" id="">
                        <option value="+880" selected>+880</option>
                        <option value="+91">+91</option>
                        <option value="+92">+92</option>
                        <option value="+86">+86</option>
                    </select>
                    <input type="text" name="contact" id="" value="{{old('contact')}}" size="15">
                </td>
                <td>
                    <span class="err" style="color:red;">
                        @error("contact")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Present address:</td>
                <td><textarea name="present_address" id="" cols="25" rows="5">{{old('present_address')}}</textarea></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("present_address")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Permanent address:</td>
                <td><textarea name="permanent_address" id="" cols="25" rows="5">{{old('permanent_address')}}</textarea></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("permanent_address")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td>Upload image:</td>
                <td><input type="file" name="customer_image" id=""></td>
                <td>
                    <span class="err" style="color:red;">
                        @error("customer_image")
                            {{$message}}
                        @enderror
                    </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Sign up"></td>
            </tr>
        </table>
    </form>
@endsection