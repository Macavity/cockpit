import { Component, Type } from '@angular/core';
import { Routes, ROUTER_DIRECTIVES } from '@angular/router';

import { BaseComponent } from "./base.component";
import { FirstComponent } from './FirstComponent/FirstComponent';
import { SecondComponent } from './SecondComponent/SecondComponent';

// Partials
import { ContentComponent } from "./partials/content.component";
import { SidebarComponent } from "./partials/sidebar.component";
import { NavbarComponent } from "./partials/navbar.component";
import { HeaderComponent } from "./partials/header.component";

// Modules
import { DashboardComponent } from "./dashboard.component";

@Routes([
    <any> {
        path: '/',
        component: DashboardComponent
    }
])
@Component({
    'directives': <any> [
        ROUTER_DIRECTIVES,
        HeaderComponent,
        NavbarComponent,
        SidebarComponent,
        ContentComponent
    ],
    'selector': 'app',
    'templateUrl': '/templates/app'
})
export class AppComponent extends BaseComponent {
}