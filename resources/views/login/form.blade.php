<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<body>
    <main>
        @include('sweetalert::alert')
        <header>
            <h1>Login</h1>
        </header>
        <main id="content">
            <form class="form" action="{{ route('authenticate') }}" method="post">
                @csrf
                <table>
                    <tr>
                        <td><strong>E-mail</strong></td>
                        <td class="blue">::</td>
                        <td> <input type="text" name="email" required /></td>
                    </tr>
                    <tr>
                        <td><strong> Password</strong></td>
                        <td class="blue">::</td>
                        <td><input type="password" name="password" required /> </label><br /></td>
                    </tr>
                </table>
                <br>
                <input type="submit" value='Login' >
                @error('credentials')
                <div class="warn">{{ $message }}</div>
                @enderror

            </form>
        </main>
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