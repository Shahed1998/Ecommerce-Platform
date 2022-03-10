@extends('layouts.customer')
@section('content')
    @if(Session::has('update_status')) 
        @if(Session::get('update_status') == true)
            <span style="display:block; color:#fff;
             width:100%; background-color:green; text-align:center; margin-bottom:5px;">
                User updated successfully
            </span>
        @else
            <span style="display:block; color:#fff;
             width:100%; background-color:red; text-align:center; margin-bottom:5px;">
                Unable to update user, invalid old password or email
            </span>
        @endif
    @endif
    <div class="inner-content">
        <div id="registration_status_message">
        <span style="color:red">
            {{Session::get('registration_status')}}
        </span>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            {{@csrf_field()}}
            {{method_field('PATCH')}}
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="uname" id="" value="{{$user_info->name}}"></td>
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
                    <td><input type="text" name="email" id="" value="{{$user_info->userCredential->email}}"></td>
                    <td>
                        <span class="err" style="color:red;">
                            @error("email")
                                {{$message}}
                            @enderror
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Old password:</td>
                    <td><input type="password" name="prev-password" id="" placeholder="Required"></td>
                    <td>
                        <span class="err" style="color:red;">
                            @error("prev-password")
                                {{$message}}
                            @enderror
                        </span>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="password" id=""></td>
                    <td>
                        <span class="err" style="color:red;">
                            @error("password")
                                {{$message}}
                            @enderror
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Confirm new password:</td>
                    <td><input type="password" name="c_password" id=""></td>
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

                            @if($user_info->gender == "Male") <option value="Male" selected>Male</option>
                            @else <option value="Male">Male</option>
                            @endif

                            @if($user_info->gender == "Female") <option value="Female" selected>Female</option>
                            @else <option value="Female">Female</option>
                            @endif
                            
                            @if($user_info->gender == "Others") <option value="Others" selected>Others</option>
                            @else <option value="Others">Others</option>
                            @endif

                        </select>
                    </td>
                    <!-- <td>
                        <span class="err" style="color:red;">
                            @error("gender")
                                {{$message}}
                            @enderror
                        </span>
                    </td> -->
                </tr>
                <tr>
                    <td>Date of birth:</td>
                    <td><input type="date" name="dob" id="" value="{{$user_info->dob}}"></td>
                </tr>
                <tr>
                    <td>Contact number:</td>
                    <td>
                        <select name="country_code" id="">

                            @if($user_info->country_code == "+880") <option value="+880" selected>+880</option>
                            @else <option value="+880">+880</option>
                            @endif

                            @if($user_info->country_code == "+91") <option value="+91" selected>+91</option>
                            @else <option value="+91">+91</option>
                            @endif

                            @if($user_info->country_code == "+92") <option value="+92" selected>+92</option>
                            @else <option value="+92">+92</option>
                            @endif

                            @if($user_info->country_code == "+86") <option value="+86" selected>+86</option>
                            @else <option value="+86">+86</option>
                            @endif
                            
                        </select>
                        <input type="text" name="contact" id="" value="{{$user_info->contact_no}}" size="15">
                    </td>
                    <!-- <td>
                        <span class="err" style="color:red;">
                            @error("contact")
                                {{$message}}
                            @enderror
                        </span>
                    </td> -->
                </tr>
                <tr>
                    <td>Present address:</td>
                    <td><textarea name="present_address" id="" cols="25" rows="5">{{$user_info->present_address}}</textarea></td>
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
                    <td><textarea name="permanent_address" id="" cols="25" rows="5">{{$user_info->permanent_address}}</textarea></td>
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
                    <td><input type="submit" class="btn btn-primary w-50" name="submit" value="Update"></td>
                    
                </tr>
            </table>
        </form>
    </div>
@endsection