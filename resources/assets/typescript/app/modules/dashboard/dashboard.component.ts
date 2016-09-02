
import { Component, OnInit } from '@angular/core';

import {DashboardService} from "./dashboard.service.ts";
import {Dashboard} from "./dashboard";

@Component({
    selector: 'dashboard',
    template: require('./dashboard.html'),
    providers: [ DashboardService ],
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
