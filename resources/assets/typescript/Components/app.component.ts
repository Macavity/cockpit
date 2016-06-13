import { Component, Type } from '@angular/core';
import { RouteConfig, RouterLink, Router, RouteDefinition } from '@angular/router-deprecated';
//import { Routes, ROUTER_DIRECTIVES } from '@angular/router';

import { BaseComponent } from "./base.component";

import { LoggedInRouterOutlet } from './../directives/logged-in-router-outlet.directive.ts';

// Partials
import { ContentComponent } from "./partials/content.component";
//import { SidebarComponent } from "./partials/sidebar.component";
import { NavbarComponent } from "./partials/navbar.component";
import { HeaderComponent } from "./partials/header.component";

// Modules
import { DashboardComponent } from "./dashboard/dashboard.component.ts";
import { LoginComponent } from "./login.component";

// Services
import { ApiService } from "../services/api.service";
import { UserService } from "../services/user.service";

@RouteConfig([
    <RouteDefinition> {
        path: '/',
        as: 'Home',
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
    },
    <RouteDefinition> {
        path: '/profile',
        as: 'Profile',
        component: DashboardComponent
    },
    <RouteDefinition> {
        path: '/settings',
        as: 'Settings',
        component: DashboardComponent
    }
])
@Component({
    'directives': <any> [
        LoggedInRouterOutlet,
        HeaderComponent,
        NavbarComponent
    ],
    providers: [
        ApiService,
        UserService
    ],
    'selector': 'app',
    'templateUrl': '/templates/frontend_layout'
})
export class AppComponent {
    constructor() {
        //
    }
}