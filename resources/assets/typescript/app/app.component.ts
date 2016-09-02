
import { Component, OnInit, Type } from '@angular/core';
import { Router } from '@angular/router';

import { UserService } from "./Services/user.service";
import { ApiService } from "./Services/api.service";
import { NavbarComponent } from "./Components/partials/navbar.component";
import { HeaderComponent } from "./Components/partials/header.component";
import { LoggedInRouterOutlet } from "./directives/logged-in-router-outlet.directive";
@Component({
    'directives': <Type[]> [
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
export class AppComponent implements OnInit {

    public isLoggedIn = false;
    public isAdmin = false;

    constructor(
        private userService: UserService,
        private router: Router) {
        //
    }

    ngOnInit() {
        this.userService.isLoggedIn.subscribe(this.onLoginStatusChange);
    }

    onLoginStatusChange = (response) => {
        this.isLoggedIn = response;
        if (this.isLoggedIn) {
            this.router.navigate(['/Dashboard']);
        } else {
            this.router.navigate(['/Login']);
        }
    };
}
