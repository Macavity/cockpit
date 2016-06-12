<aside class="left-side sidebar-offcanvas">
  <section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="img/26115.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, Jane</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..." />
            <span class="input-group-btn">
                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <ul class="sidebar-menu">
      <li [class.active]="url == ''">
        <a [routerLink]="['/dashboard']" (click)="updateUrl('')">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li [class.active]="url == 'projects'" (click)="updateUrl('projects')">
        <a [routerLink]="['/projects']">
          <i class="fa fa-gavel"></i> <span>Projects</span>
          <span class="amount pull-right">@{{ dashboard.projectCount }}</span>
        </a>
      </li>
      <li [class.active]="url == 'workers'" (click)="updateUrl('workers')">
        <a [routerLink]="['/workers']">
          <i class="fa fa-globe"></i> <span>Workers</span>
          <span class="amount pull-right">@{{ dashboard.workerCount }}</span>
        </a>
      </li>
      <li [class.active]="url == 'clients'" (click)="updateUrl('clients')">
        <a [routerLink]="['/clients']">
          <i class="fa fa-glass"></i> <span>Clients</span>
          <span class="amount pull-right">@{{ dashboard.clientCount }}</span>
        </a>
      </li>
      <li [class.active]="url == 'organisations'" (click)="updateUrl('organisations')">
        <a [routerLink]="['/organisations']">
          <i class="fa fa-glass"></i> <span>Organisations</span>
          <span class="amount pull-right">@{{ dashboard.organisationCount }}</span>
        </a>
      </li>
    </ul>
  </section>
</aside>