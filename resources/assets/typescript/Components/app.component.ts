import { Component, Type } from '@angular/core';
import { RouteConfig, RouterLink, Router, RouteDefinition } from '@angular/router-deprecated';
//import { Routes, ROUTER_DIRECTIVES } from '@angular/router';

import { BaseComponent } from "./base.component";

import { LoggedInRouterOutlet } from './logged.in.outlet.directive';

// Partials
import { ContentComponent } from "./partials/content.component";
import { SidebarComponent } from "./partials/sidebar.component";
import { NavbarComponent } from "./partials/navbar.component";
import { HeaderComponent } from "./partials/header.component";

// Modules
import { DashboardComponent } from "./dashboard.component";
import { LoginComponent } from "./login.component";

@RouteConfig([
    <RouteDefinition> {
        path: '/',
        redirectTo: ['/Dashboard']
    },
    <RouteDefinition> {
        path: '/login',
        as: 'Login',
        component: LoginComponent
    },
    <RouteDefinition> {
        path: '/dashboard',
        as: 'Dashboard',
        component: DashboardComponent
    }
])
@Component({
    'directives': <any> [
        LoggedInRouterOutlet,
        HeaderComponent,
        NavbarComponent,
        SidebarComponent
    ],
    'selector': 'app',
    'templateUrl': '/templates/frontend_layout'
})
export class AppComponent {
    constructor() {
        //
    }
}