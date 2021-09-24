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
        @include('sweetalert::alert')
        <header>
            <h1>@yield('title')</h1>
        </header>
        @auth
        <nav class="user">
            <span>{{ \Auth::user()->name }}</span>
            <a href="{{ route('logout') }}">Logout</a>
        </nav>
        @endauth

        <nav>
            <a href="{{route('product-list')}}">Product</a>
            <a href="{{route('category-list')}}">Category</a>
            <a href="{{route('shop-list')}}">Shop</a>
            <a href="{{route('user-list')}}">User</a>
        </nav>

        @if(session()->has('status'))
        <div class="status">
            <span class="info">{{session()->get('status')}}</span>
        </div>
        @endif

        @error('error')
        <div class="status">
            <span class="error">{{ $message }}</span>
        </div>
        @enderror
        <br>

        <section>
            @yield('content')
        </section>

        <footer class="footer">
            Copyright Week-07, 2021 Janyarat's Database
        </footer>
    </main>
</body>

</html>