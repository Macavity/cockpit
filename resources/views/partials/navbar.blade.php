<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="{{ route('home') }}">Cockpit</a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>
  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li>
          <a href="{{ url('/login') }}">
            <i class="icon-user"></i>
            <span class="visible-xs-inline-block position-right"> Login</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/contact') }}">
            <i class="icon-bubble-lines4"></i>
            <span class="visible-xs-inline-block position-right"> Contact Admin</span>
          </a>
        </li>
      @else
        <li>
          <a href="{{ url('/profile') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }}
            <span class="caret"></span>
          </a>
        </li>
        <li>
          <a href="{{url('/logout')}}">
            <i class="icon-exit"></i>
            <span class="visible-xs-inline-block position-right"> Logout</span>
          </a>
        </li>
      @endif


    </ul>
  </div>
</nav>