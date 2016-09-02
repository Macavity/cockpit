import { NgModule, ApplicationRef, OnInit, OnDestroy } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

/*
 * Platform and Environment providers/directives/pipes
 */
import { ENV_PROVIDERS } from '../environment';
import { APP_ROUTING } from './app.routes';

// App is our top level component
import { AppComponent } from './app.component';
import { APP_RESOLVER_PROVIDERS } from './app.resolver';
import { LoginComponent } from "./modules/login/login.component";
import { DashboardComponent } from "./modules/dashboard/dashboard.component";
import { NoContentComponent } from "./modules/no-content/no-content";

import { ApiService } from "./services/api.service";
import { AuthService } from "./services/auth.service";
import { UserService } from "./services/user.service";
import { NavigationService } from "./modules/navigation/navigation.service";
import { LanguageService } from "./services/language/language.service";
import { HomeComponent } from "./modules/home/home.component";
import { HeaderComponent } from "./components/header.component";
import { AuthHttp, provideAuth } from "angular2-jwt";
import { AuthGuard } from "./services/auth.guard";

// Application wide providers
const APP_PROVIDERS = [
    ...APP_RESOLVER_PROVIDERS,

    // AuthHttp
    AuthHttp,
    provideAuth(AuthService.getAuthConfig()),

    // App Services
    ApiService,
    LanguageService,
    NavigationService,
    UserService,
    AuthService,
    AuthGuard,
];

/**
 * `AppModule` is the main entry point into Angular2's bootstraping process
 */
@NgModule({
    bootstrap: [ AppComponent ],
    declarations: [
        // App Components
        AppComponent,
        LoginComponent,
        DashboardComponent,

        NoContentComponent,
        HomeComponent,
        HeaderComponent
    ],
    imports: [
        // import Angular's modules
        BrowserModule,
        FormsModule,
        HttpModule,

        // Our Modules
        APP_ROUTING,
    ],
    providers: [ // expose our Services and Providers into Angular's dependency injection
        ENV_PROVIDERS,
        APP_PROVIDERS,
    ]
})
export class AppModule { }
