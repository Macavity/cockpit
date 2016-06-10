import { ROUTER_DIRECTIVES } from '@angular/router';
import { Component, OnInit } from '@angular/core';

import {DashboardService} from "./dashboard/dashboard.service";
import {Dashboard} from "./dashboard/dashboard";

@Component({
    selector: 'dashboard',
    templateUrl: '/templates/dashboard',
    providers: [ DashboardService ],
    directives: [ ROUTER_DIRECTIVES ]
})
export class DashboardComponent implements OnInit {
    
    private dashboard: Dashboard = new Dashboard();
    private errorMessage;

    constructor(private statisticsService: DashboardService) {

    }

    ngOnInit() {
        this.getDashboard();
    }

    private getDashboard() {
        this.statisticsService
            .getDashboard()
            .subscribe(
                data => this.dashboard = <any> data,
                error => this.errorMessage = <any> error
            );
    }
}