@extends('layouts.customer')
@section('content')
    <section class="inner-content-dashboard">
        <div class="inner-content">
        <section class="profile-pic">
            <img src="{{asset($info->image)}}" class="profile-img" alt="Profile picture">
        </section>
        
        <table>
            <tr>
                <td>Joined as:</td>
                <td>
                    <input type="text" name="" id="" disabled value="{{$info->userCredential->userRole->user_role}}">
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="uname" id="" disabled value="{{$info->name}}"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" id="" disabled value="{{$info->userCredential->email}}"></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="text" name="" id="" disabled value="{{$info->gender}}" ></td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td><input type="date" name="dob" id=""  disabled value="{{$info->dob}}"></td>
            </tr>
            <tr>
                <td>Contact number:</td>
                <td>
                    <input type="text" name="contact" id="" disabled value="{{$info->country_code}}{{$info->contact_no}}" size="15">
                </td>
            </tr>
            <tr>
                <td>Present address:</td>
                <td><textarea disabled name="present_address" id="" cols="25" rows="5">{{$info->present_address}}</textarea></td>
            </tr>
            <tr>
                <td>Permanent address:</td>
                <td><textarea disabled name="permanent_address" id="" cols="25" rows="5">{{$info->permanent_address}}</textarea></td>
            </tr>
        </table>
        </div>
    </section>
@endsection