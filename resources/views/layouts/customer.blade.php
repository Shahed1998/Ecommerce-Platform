<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">
    <title>Ecommerce Platform</title>
</head>
<body>
    <section id="customer-content">
        <h1>
            {{$pageName ?? ""}}
        </h1>
        <div class="left-bar shadow p-3 mb-5 bg-body rounded">
            <div class="inner-content">
            <a href="{{route('home')}}"><i class="fa-solid fa-circle-left"></i> Home</a>
            <a href="{{route('customerDashboard')}}"><i class="fa-solid fa-circle-right"></i> View profile</a>
            <a href="{{route('customerEdit')}}"><i class="fa-solid fa-circle-right"></i> Edit/Delete profile</a>
            <a href="{{route('customer.product.view')}}"><i class="fa-solid fa-circle-right"></i> View shop</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View cart</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View orders</a>
            <a href="{{route('logout')}}"><i class="fa-solid fa-circle-left"></i> Logout</a>
            </div>
        </div>
        <div class="right-bar">
            @yield('content')
        </div>
        <div class="footer">
            <h3>Designed and Developed by <span style="color:red;">Shahed</span></h3>
        </div>
    </section>
</body>
</html>