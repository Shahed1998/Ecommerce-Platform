@extends('layouts.home')
@section('content')
    <form action="" method="post">
        {{@csrf_field()}}
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="uname" id=""></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" id=""></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><input type="password" name="c_password" id=""></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <select name="gender" id="" >
                        <option value="" disabled selected>Select gender below</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Contact number:</td>
                <td><input type="text" name="contact" id=""></td>
            </tr>
            <tr>
                <td>Present address:</td>
                <td><textarea name="present_address" id="" cols="25" rows="5"></textarea></td>
            </tr>
            <tr>
                <td>Permanent address:</td>
                <td><textarea name="permanent_address" id="" cols="25" rows="5"></textarea></td>
            </tr>
            <tr>
                <td>Upload image:</td>
                <td><input type="file" name="customer_image" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Sign up"></td>
            </tr>
        </table>
    </form>
@endsection