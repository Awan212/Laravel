<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>
    <link rel="shortcut icon" href="{{ asset('logo/school-logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <link rel="stylesheet" href="{{ asset('css/customstyle.css') }}">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <div class="landing-page">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Image and text -->
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('logo/school-logo.png') }}" width="50" height="50" class="d-inline-block "
                        alt="">
                    The grammer school
                </a>
            </nav>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
               <!-- <ul class="navbar-nav h4 m-auto nav-pills nav-stacked">
                    <li class="nav-item active">
                        <a href="#section1" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a href="#section2" class="nav-link">About</a>
                    </li>
                    <li class="nav-item active">
                        <a href="#section3" class="nav-link">Contact</a>
                    </li>

                </ul> -->
                <ul class="navbar-nav h4 ml-auto">
                    @if (Route::has('login'))
                    <li class="nav-item active">
                        @auth
                        <a href="{{ url('/home') }}" class="nav-link">Home</a>
                        @else
                        <a href="{{ route('login') }}" class="nav-link bg-dark rounded text-light">Portal</a>
                        @endif
                    </li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="row w-100" id="section1">
            <div class="col-md-4">
                <p class="heading">Welcome To School</p>
                <a href="#section2" class="btn read-more">Read More</a>
                <p class="intro-line">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, repellat illo! Mollitia ea vel sint, voluptates ratione atque eum ipsum. Harum itaque dolore eos repudiandae unde ut asperiores modi fuga!</p>
            </div>

            <div class="col-md-8">
                <img src="{{ asset('logo/banner.jpg') }}" alt="" width="100%" height="auto">
            </div>
        </div>


      


</body>

</html>