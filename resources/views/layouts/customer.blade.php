<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">
    <title>Ecommerce Platform</title>
</head>
<body>
    <section id="customer-content">
        <h1>
            {{$pageName ?? ""}}
        </h1>
        <div class="left-bar">
            <div class="inner-content">
            <a href="{{route('home')}}"><i class="fa-solid fa-circle-left"></i> Home</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View profile</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> Edit profile</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View shop</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View cart</a>
            <a href=""><i class="fa-solid fa-circle-right"></i> View orders</a>
            <a href=""><i class="fa-solid fa-circle-left"></i> Logout</a>
            </div>
        </div>
        <div class="right-bar">
            @yield('content')
        </div>
    </section>

    <section id="footer">
        <h3>Designed and Developed by <span style="color:red;">Shahed</span></h3>
    </section>
</body>
</html>