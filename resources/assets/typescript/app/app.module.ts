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
import { ApiService } from "./Services/api.service";
import { UserService } from "./Services/user.service";
import { LoginComponent } from "./modules/login.component";
import { DashboardComponent } from "./modules/dashboard/dashboard.component";



// Application wide providers
const APP_PROVIDERS = [
    ...APP_RESOLVER_PROVIDERS,

    ApiService,
    //LanguageService,
    //NavigationService,
    UserService,
    AuthService,
];

/**
 * `AppModule` is the main entry point into Angular2's bootstraping process
 */
@NgModule({
    bootstrap: [ AppComponent ],
    declarations: [
        AppComponent,
        LoginComponent,
        DashboardComponent,

        NoContentComponent,
    ],
    imports: [
        // import Angular's modules
        BrowserModule,
        FormsModule,
        HttpModule,

        // Our Modules
        APP_ROUTING,
        CourseModule,
        UserModule,
        BookingOverviewModule,
        ServicesOverviewModule
    ],
    providers: [ // expose our Services and Providers into Angular's dependency injection
        ENV_PROVIDERS,
        APP_PROVIDERS,
    ]
})
export class AppModule { }
