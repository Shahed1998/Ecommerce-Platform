<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- for bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> <!-- for fontawesome -->

    <title>Admin | User profile</title>
</head>
<body>
    <!-- Header Starts -->
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-2">
            <div class="container">
            <a href="{{route('admin.home')}}" class="navbar-brand text text-primary">Ecommerce Platform</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown mr-3">
                    <a href="{{route('admin.profileView')}}" class="nav-link">
                    <i class="fas fa-user"></i> &nbsp {{Session::get('name')}}
                    </a>
                    <div class="dropdown-menu mt-2 ml-3 bg-light">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                    <i class="fas fa-user-times"></i>&nbsp Logout
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>
    <br><br>
    <!-- Header Ends -->

    <!-- Main Body Starts -->
    <main id="main ">
        <div class="">
            <div class="row mt-2 justify-content-around">
                <div class="col-12 col-lg-2 border border-dark bg-light rounded p-3">
                        <div class="text-left mt-2 rounded">
                            @if($user_info->image)
                                <img class="profile-img" src="{{asset($user_info->image)}}" alt="{{$user_info->uc_id}}" width="200" height="200">
                            @else
                                <img src="#" alt="Nothing Found!" width="200" height="200">
                            @endif
                            <h4>{{$user_info->name}}</h4>
                            <a href="{{route('admin.profileEdit')}}" class="btn btn-primary btn-sm mb-2">Edit Profile</a>
                        </div>
                    </div>
                <div class="col-12 col-lg-9 border border-dark rounded p-3">
                        <div class="container">
                            <div class="row justify-content-center">
                                <h3><i class="fas fa-user"></i> Profile</h3>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="container">
                            <div class="row justify-content-center mb-2">
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
                            </div>
                        </div>
                        <div class="container">
                            <div class="text-left">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td >Name</td>
                                        <td > {{$user_info->name}}</td>
                                    </tr>
                                    <tr>
                                        <td >Email</td>
                                        <td > {{$user_cred->email}} </td>
                                    </tr>
                                    <tr>
                                        <td >Gender</td>
                                        <td >{{$user_info->gender}}</td>
                                    </tr>
                                    <tr>
                                        <td >Date of Birth</td>
                                        <td >{{$user_info->dob}}</td>
                                    </tr>
                                    <tr>
                                        <td >Contact</td>
                                        <td >{{$user_info->contact_no}}</td>
                                    </tr>
                                    <tr>
                                        <td >Present address</td>
                                        <td > {{$user_info->present_address}} </td>
                                    </tr>
                                    <tr>
                                        <td >Permanent address</td>
                                        <td > {{$user_info->permanent_address}} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main Body Ends -->

  <!-- Footer Starts-->
    <footer  class="bg-dark text-white mt-5 p-3">
            <div class="container">
            <div class="row">
                <div class="col">
                <p class="lead text-center">
                    Copyright &copy Ecommerce Platform 2022
                </p>
                </div>
            </div>
            </div>
        </footer>
    <!-- Footer Ends -->
</body>
</html>