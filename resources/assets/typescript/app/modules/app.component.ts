import { Component, Type, OnInit, Inject } from '@angular/core';
import { RouteConfig, RouterLink, Router, RouteDefinition } from '@angular/router-deprecated';

import { BaseComponent } from "./base.component";

import { LoggedInRouterOutlet } from '../directives/logged-in-router-outlet.directive.ts';

// Partials
import { ContentComponent } from "./partials/content.component";
//import { SidebarComponent } from "./partials/sidebar.component";
import { NavbarComponent } from "./partials/navbar.component";
import { HeaderComponent } from "./partials/header.component";

// Modules
import { DashboardComponent } from "./dashboard/dashboard.component.ts";
import { LoginComponent } from "./login.component";

// Services
import { ApiService } from "../Services/api.service";
import { UserService } from "../Services/user.service";

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

