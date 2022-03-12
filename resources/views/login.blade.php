<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <h2><a href="{{route('home')}}"  class="linkBtn gobackBtn">Ecommerce Platform</a><h2>
</head>
<body>
    <hr>
    <form action="{{route('login.submit')}}" method="post">
    {{@csrf_field()}}
    <div class="box1">
        <h3>Login</h3>
        <div class="lg"><input type="text" name="email" placeholder="Email" value="{{old('email')}}"></div>
        <div class="lg"><input type="password" name="password" placeholder="Password" ></div>
        <button class="button1" type="submit">Login</button>
        @if(Session::get('msg'))
        <span style="color:red">{{Session::get('msg')}}<span>
        @endif
    </div>
    <br><br><br>
    <h4 style="text-align:center">Copyright &copy Ecommerce Platform</h4>
</body>
</html>