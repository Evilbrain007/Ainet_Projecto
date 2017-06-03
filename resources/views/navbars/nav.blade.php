<div class="navbar navbar-static-top navbar-inverse">

    <div class="container">

        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a href="{{route('home')}}">
                <img src="{{URL::asset('/images/printit.png')}}" alt="profile Pic" height="50" width="150">
            </a>
        </div>


        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @include('navbars.links')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    @include('navbars.not-logged-in')
                @else
                    @include('navbars.logged-in')
                @endif
            </ul>
        </div>

    </div>

</div>
