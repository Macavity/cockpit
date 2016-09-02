import { Type } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

// Modules
import { AuthGuard } from './services/auth.guard';

// Pages
import { DashboardComponent } from "./modules/dashboard/dashboard.component";
import { LoginComponent } from './modules/login/login.component';
import { NoContentComponent } from "./modules/no-content/no-content";
import { HomeComponent } from "./modules/home/home.component";

const APP_ROUTES: Routes = [

    /*
     * Authentication protected routes
     */
    { path: 'dashboard', component: <Type> DashboardComponent, canActivate: [ AuthGuard ] },

    /*
     * Public Routes
     */
    { path: 'login', component: <Type> LoginComponent },

    { path: '', component: <Type> HomeComponent, terminal: true, pathMatch: 'full' },

    // Fallback Path
    { path: '**', component: <Type> NoContentComponent }
];

export const APP_ROUTING = RouterModule.forRoot(APP_ROUTES);
