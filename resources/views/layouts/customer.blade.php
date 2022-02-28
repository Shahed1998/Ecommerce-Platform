<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Platform</title>
</head>
<body>
    <section id="navbar">

    </section>
    <section id="content">
        <h1>
            {{$pageName ?? ""}}
        </h1>
        @yield('content')
    </section>
    <section id="footer">
        <h3>Designed and Developed by<span style="color:red;">Shahed</span></h3>
    </section>
</body>
</html>