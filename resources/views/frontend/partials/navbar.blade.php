<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="/" *ngIf="isGuest">Cockpit</a>
    <a class="navbar-brand" [routerLink]="['Dashboard']" *ngIf="isUser">Cockpit</a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>
  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right" *ngIf="isGuest">
      <li>
        <a [routerLink]="['Login']">
          <i class="icon-user"></i>
          <span class="visible-xs-inline-block position-right"> Login</span>
        </a>
      </li>
      {{--
      <li>
        <a [routerLink]="['Contact']">
          <i class="icon-bubble-lines4"></i>
          <span class="visible-xs-inline-block position-right"> Contact Admin</span>
        </a>
      </li>--}}
    </ul>
    <ul class="nav navbar-nav navbar-right" *ngIf="isUser">
      <!-- Language Switch -->
      <li class="dropdown language-switch" *ngIf="currentLanguage">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <img [src]="currentLanguage.icon" class="position-left" alt="">
          @{{ currentLanguage.label }}
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li *ngFor="let lang of languages"><a (click)="changeLanguage(lang)"><img [src]="lang.icon" alt=""> @{{ lang.label }}</a></li>
        </ul>
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
          <li><a [routerLink]="['Profile']"><i class="icon-user-plus"></i> My profile</a></li>
          {{--
          <li><a [routerLink]="['Messages']">
              <span class="badge badge-warning pull-right" *ngIf="user.messages.length > 0">@{{ user.messages.length }}</span>
              <i class="icon-comment-discussion"></i> Messages</a>
          </li>
          <li><a [routerLink]="['Settings']"><i class="icon-cog5"></i> Account settings</a></li>
          --}}
          <li class="divider"></li>
          <li><a (click)="logout()"><i class="icon-switch2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>