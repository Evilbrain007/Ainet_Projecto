<div class="navbar navbar-static-top navbar-inverse">
    @if(Auth::check())
        @include('navbars.logged-in')
    @else
        @include('navbars.not-logged-in')
    @endif
</div>

