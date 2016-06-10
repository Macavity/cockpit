<div class="row" style="margin-bottom:5px;">
    <div class="col-md-3">
        <a [routerLink]="['/projects']" class="sm-st clearfix">
            <span class="sm-st-icon st-red"><i class="fa fa-check-square-o"></i></span>
            <div class="sm-st-info">
                <span>@{{ statistics.projectCount }}</span> Projects
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a [routerLink]="['/workers']" class="sm-st clearfix">
            <span class="sm-st-icon st-violet"><i class="fa fa-envelope-o"></i></span>
            <div class="sm-st-info">
                <span>@{{ statistics.workerCount }}</span> Workers
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a [routerLink]="['/clients']" class="sm-st clearfix">
            <span class="sm-st-icon st-blue"><i class="fa fa-dollar"></i></span>
            <div class="sm-st-info">
                <span>@{{ statistics.clientCount }}</span> Clients
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a [routerLink]="['/organisations']" class="sm-st clearfix">
            <span class="sm-st-icon st-green"><i class="fa fa-paperclip"></i></span>
            <div class="sm-st-info">
                <span>@{{ statistics.organisationCount }}</span> Organisations
            </div>
        </a>
    </div>
</div>