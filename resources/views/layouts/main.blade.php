<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<body>
    <main>
        <header>
            <h1>@yield('title')</h1>
        </header>

        <nav>
            <a href="{{route('product-list')}}">Product</a>
            <a href="{{route('shop-list')}}">Shop</a>
        </nav>
        
        <section>
            @yield('content')
        </section>

        <footer>
            Copyright Week-07, 2021 Janyarat's Database
        </footer>
    </main>
</body>

</html>