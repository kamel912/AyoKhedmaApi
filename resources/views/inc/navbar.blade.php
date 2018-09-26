<nav class="navbar navbar-inverse navbar-static-top " style="height: fit-content">
    <div class="container">
        <div class="navbar-header navbar-right">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <img class="navbar-brand" href="{{ url('/') }}" src="/storage/mainlogo.png">
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <!-- Authentication Links -->
                @guest
                    <li><a style="color: #FFFFFF" href="{{ route('login') }}">تسجيل الدخول</a></li>
                    <li><a style="color: #FFFFFF" href="{{ route('register') }}">التسجيل</a></li>
                @else
                    <li class="dropdown">
                        <a style="color: #FFFFFF" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    تسجيل الخروج
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
