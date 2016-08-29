
import { RouteConfig, RouterLink, Router, RouteDefinition } from '@angular/router-deprecated';
import { Component, OnInit } from '@angular/core';

import {DashboardService} from "./dashboard.service.ts";
import {Dashboard} from "./dashboard";

@Component(<any> {
    selector: 'dashboard',
    templateUrl: '/templates/dashboard',
    providers: [ DashboardService ],
    directives: [ RouterLink ]
})
export class DashboardComponent implements OnInit {
    
    private dashboard: Dashboard = new Dashboard();
    private errorMessage;

    constructor(private service: DashboardService) {

    }

    ngOnInit() {
        this.getDashboard();
    }

    private getDashboard() {
        /*this.service
            .getDashboard()
            .subscribe(
                data => this.dashboard = <any> data,
                error => this.errorMessage = <any> error
            );*/
    }
}