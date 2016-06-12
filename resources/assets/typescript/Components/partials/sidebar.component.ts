import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router-deprecated';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Location }          from '@angular/common';

import {Dashboard} from "../dashboard/dashboard";
import {DashboardService} from "../dashboard/dashboard.service";

@Component({
    selector: 'second-navbar',
    templateUrl: '/templates/partials.sidebar',
    directives: [ ],
    providers: [ DashboardService, Location ]
    
})
export class SidebarComponent implements OnInit {
    
    private dashboard: Dashboard = new Dashboard();
    private errorMessage;
    private url: string = '';
    
    constructor(
        private location: Location,
        private dashboardService: DashboardService
    ) {}
    
    ngOnInit() {
        this.getDashboard();
    }

    private getDashboard() {
        this.dashboardService
            .getDashboard()
            .subscribe(
                data => this.dashboard = <any> data,
                error => this.errorMessage = <any> error
            );
    }
    
    public updateUrl(url) {
        this.url = url;
    }
}
