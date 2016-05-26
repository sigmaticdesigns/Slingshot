<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SlingShot | @yield('title', 'Home')</title>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,300' rel='stylesheet' type='text/css'>
    <link href="/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="page-header">
    <div class="container">
        <div class="logo"><a href="/"><span>SLING</span>-SHOT</a></div>
        <nav class="main-nav">
            <ul class="main-nav__list">
                <li class="main-nav__item"><a href="">How it works</a></li>
                <li class="main-nav__item"><a href="">Projects</a></li>
                <li class="main-nav__item"><a href="">About us</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            @if (Auth::check())
                You're logged in as {!! Auth::user()->name !!} ({!! Auth::user()->email !!}) <br/>
                <a href="/auth/logout" class="user-menu__itemt"> Logout </a>
                <a href="{{ url ('settings') }}" class="user-menu__item"> User Settings </a>
            @else
                <a href="{{ url ('/auth/register') }}" class="user-menu__item">Sign up</a>
                <a href="{{ url ('/auth/login') }}" class="user-menu__item">Log in</a>
            @endif
                <a href="{!! route('user.projects.create') !!}" class="user-menu__btn btn">Create a project</a>
        </div>
    </div>
</header>
<main>



        @yield('content')



</main>
<footer class="main-footer">


    @include('partials.footer')



</footer>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="{{ asset('/js/all.js') }}"></script>

@include('partials.errors')

</body>
</html>
