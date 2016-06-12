<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="/" *ngIf="isGuest">Cockpit</a>
    <a class="navbar-brand" href="/dashboard" *ngIf="isUser">Cockpit</a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>
  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right" *ngIf="isGuest">
      <li>
        <a href="/login">
          <i class="icon-user"></i>
          <span class="visible-xs-inline-block position-right"> Login</span>
        </a>
      </li>
      <li>
        <a href="/contact">
          <i class="icon-bubble-lines4"></i>
          <span class="visible-xs-inline-block position-right"> Contact Admin</span>
        </a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right" *ngIf="isUser">
      <!-- Language Switch -->
      <li class="dropdown language-switch">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <img src="/images/flags/gb.png" class="position-left" alt="">
          English
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li><a class="deutsch"><img src="/images/flags/de.png" alt=""> Deutsch</a></li>
          <li><a class="english"><img src="/images/flags/gb.png" alt=""> English</a></li>
        </ul>
      </li>

      <!-- Messages -->
      <li class="dropdown">
        <a href="{{url('/messages')}}" class="dropdown-toggle" data-toggle="dropdown">
          <i class="icon-bubbles4"></i>
          <span class="visible-xs-inline-block position-right">Messages</span>
          <span class="badge bg-warning-400">0</span>
        </a>

        <div class="dropdown-menu dropdown-content width-350">
          <div class="dropdown-content-heading">
            Messages
            <ul class="icons-list">
              <li><a href="#"><i class="icon-compose"></i></a></li>
            </ul>
          </div>

          <ul class="media-list dropdown-content-body">
            <li class="media">
              <div class="media-left">
                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                <span class="badge bg-danger-400 media-badge">5</span>
              </div>

              <div class="media-body">
                <a href="#" class="media-heading">
                  <span class="text-semibold">James Alexander</span>
                  <span class="media-annotation pull-right">04:58</span>
                </a>

                <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
              </div>
            </li>

            <li class="media">
              <div class="media-left">
                <img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
                <span class="badge bg-danger-400 media-badge">4</span>
              </div>

              <div class="media-body">
                <a href="#" class="media-heading">
                  <span class="text-semibold">Margo Baker</span>
                  <span class="media-annotation pull-right">12:16</span>
                </a>

                <span class="text-muted">That was something he was unable to do because...</span>
              </div>
            </li>

            <li class="media">
              <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
              <div class="media-body">
                <a href="#" class="media-heading">
                  <span class="text-semibold">Jeremy Victorino</span>
                  <span class="media-annotation pull-right">22:48</span>
                </a>

                <span class="text-muted">But that would be extremely strained and suspicious...</span>
              </div>
            </li>

            <li class="media">
              <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
              <div class="media-body">
                <a href="#" class="media-heading">
                  <span class="text-semibold">Beatrix Diaz</span>
                  <span class="media-annotation pull-right">Tue</span>
                </a>

                <span class="text-muted">What a strenuous career it is that I've chosen...</span>
              </div>
            </li>

            <li class="media">
              <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>
              <div class="media-body">
                <a href="#" class="media-heading">
                  <span class="text-semibold">Richard Vango</span>
                  <span class="media-annotation pull-right">Mon</span>
                </a>

                <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
              </div>
            </li>
          </ul>

          <div class="dropdown-content-footer">
            <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
          </div>
        </div>
      </li>

      <!-- Profile -->
      <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <div class="btn bg-success-400 btn-rounded btn-icon btn-xs">
            <span class="letter-icon">A</span>
          </div>
          <span>@{{user.name}}</span>
          <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="/profile"><i class="icon-user-plus"></i> My profile</a></li>
          <li><a href="/messages">
              <span class="badge badge-warning pull-right">58</span>
              <i class="icon-comment-discussion"></i> Messages</a>
          </li>
          <li class="divider"></li>
          <li><a href="/settings"><i class="icon-cog5"></i> Account settings</a></li>
          <li><a href="/logout"><i class="icon-switch2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>