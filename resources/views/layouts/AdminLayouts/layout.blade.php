<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> <!-- for fontawesome -->
    </head>
    <body>



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


       
        @include('Admin.Headers.header')
        <main id="main ">
            <div class="">
                <div class="row justify-content-around">
                    <div class="col-12 col-lg-2 border border-dark bg-light rounded p-3">
                        <div class="text-left mt-2 rounded">
                            <h4>Customers</h4>
                            <a href="{{route('admin.customer.pending')}}" class="btn btn-outline-dark btn-sm mb-2">Pending</a> 
                            <a href="{{route('admin.customer.active')}}" class="btn btn-outline-dark btn-sm mb-2">Active</a> 
                            <a href="{{route('admin.customer.blocked')}}" class="btn btn-outline-dark btn-sm mb-2">Blocked</a> 
                        </div>
                        <div class="text-left mt-2">
                            <h4>Delivery Staffs</h4>
                            <a href="{{route('admin.DeliveryStaff.pending')}}" class="btn btn-outline-dark btn-sm mb-2">Pending</a>
                            <a href="{{route('admin.DeliveryStaff.active')}}" class="btn btn-outline-dark btn-sm mb-2">Active</a>
                            <a href="{{route('admin.DeliveryStaff.blocked')}}" class="btn btn-outline-dark btn-sm mb-2">Blocked</a>
                        </div>
                        <div class="text-left mt-2">
                            <h4>Vendors</h4>
                            <a href="{{route('admin.Vendor.pending')}}" class="btn btn-outline-dark btn-sm mb-2">Pending</a>
                            <a href="{{route('admin.Vendor.active')}}" class="btn btn-outline-dark btn-sm mb-2">Active</a>
                            <a href="{{route('admin.Vendor.blocked')}}" class="btn btn-outline-dark btn-sm mb-2">Blocked</a>
                        </div>
                        <div class="text-left mt-2">
                            <h4>Statistics</h4>
                            <a href="{{route('admin.statistics.UserRatio')}}" class="btn btn-outline-dark btn-sm mb-2">User Statistics</a>
                            <a href="{{route('admin.statistics.ProductSellingStat')}}" class="btn btn-outline-dark btn-sm mb-2">Product Selling</a>
                        </div>
                        <div class="text-left mt-2">
                            <h4>Others</h4>
                            <a href="{{route('admin.registration')}}" class="btn btn-outline-dark btn-sm mb-2">Register an Admin</a> <br>
                            <a href="{{route('admin.activites')}}" class="btn btn-outline-dark btn-sm mb-2">Activities</a> <br>
                        </div>
                    </div>
                @yield('content')
                @yield('ChartScript')
                </div>
            </div>
        </main>
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
    </body>
</html>