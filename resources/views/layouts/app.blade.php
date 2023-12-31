<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ABC</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    {{-- <link rel="stylesheet" href="/DataTables/datatables.css" />
    <script src="/DataTables/datatables.js"></script> --}}

    <style>
        * {
            border: 0;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: rgb(250, 250, 250) url(http://lorempixel.com/1920/1080/nature/);
            font-family: Lato, Helvetica, Arial, sans-serif;
        }

        a {
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            text-decoration: none;
        }


        /*======================================================
                          Navbar
  ======================================================*/
        #navbar {
            background: white;
            color: rgb(13, 26, 38);
            position: fixed;
            top: 0;
            height: 60px;
            line-height: 60px;
            width: 100vw;
            z-index: 10;
        }

        .nav-wrapper {
            margin: auto;
            text-align: center;
            width: 70%;
        }

        @media(max-width: 768px) {
            .nav-wrapper {
                width: 90%;
            }
        }

        @media(max-width: 638px) {
            .nav-wrapper {
                width: 100%;
            }
        }


        .logo {
            float: left;
            margin-left: 28px;
            font-size: 1.5em;
            height: 60px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        @media(max-width: 768px) {
            .logo {
                /*       margin-left: 5px; */
            }
        }

        #navbar ul {
            display: inline-block;
            float: right;
            list-style: none;
            /* margin-right: 14px; */
            margin-top: -2px;
            text-align: right;
            transition: transform 0.5s ease-out;
            -webkit-transition: transform 0.5s ease-out;
        }

        @media(max-width: 640px) {
            #navbar ul {
                display: none;
            }
        }

        @media(orientation: landscape) {
            #navbar ul {
                display: inline-block;
            }
        }

        #navbar li {
            display: inline-block;
        }

        #navbar li a {
            color: rgb(13, 26, 38);
            display: block;
            font-size: 0.7em;
            height: 50px;
            letter-spacing: 1px;
            margin: 0 20px;
            padding: 0 4px;
            position: relative;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.5s ease;
            -webkit-transition: all 0.5s ease;
        }

        #navbar li a:hover {
            /* border-bottom: 1px solid rgb(28, 121, 184); */
            color: rgb(28, 121, 184);
            transition: all 1s ease;
            -webkit-transition: all 1s ease;
        }

        /* Animated Bottom Line */
        #navbar li a:before,
        #navbar li a:after {
            content: '';
            position: absolute;
            width: 0%;
            height: 1px;
            bottom: -1px;
            background: rgb(13, 26, 38);
        }

        #navbar li a:before {
            left: 0;
            transition: 0.5s;
        }

        #navbar li a:after {
            background: rgb(13, 26, 38);
            right: 0;
            /* transition: width 0.8s cubic-bezier(0.22, 0.61, 0.36, 1); */
        }

        #navbar li a:hover:before {
            background: rgb(13, 26, 38);
            width: 100%;
            transition: width 0.5s cubic-bezier((0.22, 0.61, 0.36, 1));
        }

        #navbar li a:hover:after {
            background: transparent;
            width: 100%;
            /* transition: 0s; */
        }



        /*======================================================
                    Mobile Menu Menu Icon
  ======================================================*/
        @media(max-width: 640px) {
            .menuIcon {
                cursor: pointer;
                display: block;
                position: fixed;
                right: 15px;
                top: 20px;
                height: 23px;
                width: 27px;
                z-index: 12;
            }

            /* Icon Bars */
            .icon-bars {
                background: rgb(13, 26, 38);
                position: absolute;
                left: 1px;
                top: 45%;
                height: 2px;
                width: 20px;
                -webkit-transition: 0.4s;
                transition: 0.4s;
            }

            .icon-bars::before {
                background: rgb(13, 26, 38);
                content: '';
                position: absolute;
                left: 0;
                top: -8px;
                height: 2px;
                width: 20px;
                /*     -webkit-transition: top 0.2s ease 0.3s;
    transition: top 0.2s ease 0.3s; */
                -webkit-transition: 0.3s width 0.4s;
                transition: 0.3s width 0.4s;
            }

            .icon-bars::after {
                margin-top: 0px;
                background: rgb(13, 26, 38);
                content: '';
                position: absolute;
                left: 0;
                bottom: -8px;
                height: 2px;
                width: 20px;
                /*     -webkit-transition: top 0.2s ease 0.3s;
    transition: top 0.2s ease 0.3s; */
                -webkit-transition: 0.3s width 0.4s;
                transition: 0.3s width 0.4s;
            }

            /* Bars Shadows */
            .icon-bars.overlay {
                background: rgb(97, 114, 129);
                background: rgb(183, 199, 211);
                width: 20px;
                animation: middleBar 3s infinite 0.5s;
                -webkit-animation: middleBar 3s infinite 0.5s;
            }

            @keyframes middleBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 20px
                }

                100% {
                    width: 0px
                }
            }

            @-webkit-keyframes middleBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 20px
                }

                100% {
                    width: 0px
                }
            }

            .icon-bars.overlay::before {
                background: rgb(97, 114, 129);
                background: rgb(183, 199, 211);
                width: 10px;
                animation: topBar 3s infinite 0.2s;
                -webkit-animation: topBar 3s infinite 0s;
            }

            @keyframes topBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 10px
                }

                100% {
                    width: 0px
                }
            }

            @-webkit-keyframes topBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 10px
                }

                100% {
                    width: 0px
                }
            }

            .icon-bars.overlay::after {
                background: rgb(97, 114, 129);
                background: rgb(183, 199, 211);
                width: 15px;
                animation: bottomBar 3s infinite 1s;
                -webkit-animation: bottomBar 3s infinite 1s;
            }

            @keyframes bottomBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 15px
                }

                100% {
                    width: 0px
                }
            }

            @-webkit-keyframes bottomBar {
                0% {
                    width: 0px
                }

                50% {
                    width: 15px
                }

                100% {
                    width: 0px
                }
            }


            /* Toggle Menu Icon */
            .menuIcon.toggle .icon-bars {
                top: 5px;
                transform: translate3d(0, 5px, 0) rotate(135deg);
                transition-delay: 0.1s;
                transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            .menuIcon.toggle .icon-bars::before {
                top: 0;
                transition-delay: 0.1s;
                opacity: 0;
            }

            .menuIcon.toggle .icon-bars::after {
                top: 10px;
                transform: translate3d(0, -10px, 0) rotate(-270deg);
                transition-delay: 0.1s;
                transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }

            .menuIcon.toggle .icon-bars.overlay {
                width: 20px;
                opacity: 0;
                -webkit-transition: all 0s ease 0s;
                transition: all 0s ease 0s;
            }
        }


        /*======================================================
                   Responsive Mobile Menu
  ======================================================*/
        .overlay-menu {
            background: lightblue;
            color: rgb(13, 26, 38);
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            right: 0;
            padding-right: 15px;
            transform: translateX(-100%);
            width: 100vw;
            height: 100vh;
            -webkit-transition: transform 0.2s ease-out;
            transition: transform 0.2s ease-out;
        }

        .overlay-menu ul,
        .overlay-menu li {
            display: block;
            position: relative;
        }

        .overlay-menu li a {
            display: block;
            font-size: 1.8em;
            letter-spacing: 4px;
            /*   opacity: 0; */
            padding: 10px 0;
            text-align: right;
            text-transform: uppercase;
            -webkit-transition: color 0.3s ease;
            transition: color 0.3s ease;
            /*   -webkit-transition: 0.2s opacity 0.2s ease-out;
  transition: 0.2s opacity 0.2s ease-out; */
        }

        .overlay-menu li a:hover,
        .overlay-menu li a:active {
            color: rgb(28, 121, 184);
            -webkit-transition: color 0.3s ease;
            transition: color 0.3s ease;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <nav id="navbar" class="">
            <div class="nav-wrapper">
                <!-- Navbar Logo -->
                <div class="logo">
                    <a href="#home"><i class="fa fa-angellist"></i> ABC Bank</a>
                </div>

                <!-- Navbar Links -->
                <ul id="menu">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li><a href="{{ url('/home') }}">Home</a></li><!--
                            -->
                        <li><a href="{{ url('/deposit') }}">Deposit</a></li><!--
                            -->
                        <li><a href="{{ url('/withdraw') }}">Withdraw</a></li><!--
                            -->
                        <li><a href="/transfer">Transfer</a></li>
                        <li><a href="/statement">Statement</a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>


        <!-- Menu Icon -->
        <div class="menuIcon">
            <span class="icon icon-bars"></span>
            <span class="icon icon-bars overlay"></span>
        </div>


        <div class="overlay-menu">
            <ul id="menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>

            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
