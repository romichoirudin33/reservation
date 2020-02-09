<html>
<head>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield('css')

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

        b {
            color: #da2627;
        }

        .flat {
            border-radius: 0;
        }
    </style>
</head>
<body style="background: #eaeaea">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(251, 251, 251);">
    <img src="https://s3-ap-southeast-1.amazonaws.com/cdn.omnihotelier.com/media/91/Hhky2DuZWXBgW0os31EahmbPEyWEomhbyWDudIBu.png"
         style="max-height: 70px;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <i class="material-icons" style="color: rgb(64, 64, 64);">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('welcome') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Accomodation</a>
            </li>
        </ul>
    </div>
</nav>

@yield('slider')

<div class="container pt-3">
    @yield('contents')
</div>

<footer class="mb-5 mt-5">
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

@yield('js')
</body>
</html>