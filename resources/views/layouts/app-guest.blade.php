<html>
<head>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @yield('css')

    <link rel="icon" href="{{ asset('images/icon.jpeg') }}">

    <title>
        @yield('title', 'Utopic')
    </title>

    <style>
        body {
            font-family: Blogger Sans;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.6;
        }

        .white-box {
            background: #fff;
            padding: 25px;
            margin-bottom: 15px;
        }

        .text-price {
            font-size: 22px;
            color: #f2994a;
            font-weight: 700;
            font-family: sans-serif;
        }

        b {
            color: #da2627;
        }

        .flat {
            border-radius: 0;
        }

        .icon-top{
            position: relative;
            top: -7px;
            left: -3px;
        }
    </style>
</head>
<body style="background: #eaeaea">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(251, 251, 251);">
    <img src="{{ asset('images/logo.jpeg') }}"
         style="max-height: 60px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons" style="color: rgb(64, 64, 64);">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            @if (!Auth::guest())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b>{{ ucfirst(Auth::user()->name) }}</b> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="{{ route('guest.pay.index') }}">Daftar pesanan</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.book') }}">
                        Book
                        @php
                        $cek = \App\Models\Booking::where('users_id', Auth::id())
                        ->where('status', '1')
                        ->exists();
                        @endphp
                        @if($cek)
                        <span class="fa fa-circle icon-top text-danger"></span>
                        @endif
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('welcome') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guest.room') }}">Room</a>
            </li>

        </ul>
    </div>
</nav>

@yield('slider')

<div class="container pt-3">
    @yield('contents')
</div>

<footer class="mt-5 " style="background: #fff;padding: 25px;">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <strong>{{ date('Y') }} - Utopic Villa </strong> <br><br>
                <p>
                    Alamat <br>
                    Email <br>
                    Phone
                </p>
            </div>
            <div class="col-md-3">
                <strong>Follow US</strong> <br><br>
                Instagram <br>
                Facebook <br>
                Twitter <br>
            </div>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
@yield('js')
</body>
</html>