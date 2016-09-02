import { Component, OnInit, Input } from '@angular/core';

import { NavbarComponent } from "../modules/navigation/navbar.component";
import { User } from "../common/user";
import { AuthService } from "../services/auth.service";

@Component({
    selector: 'header',
    template: require('./header.html'),
    directives: [
        NavbarComponent
    ]
})
export class HeaderComponent implements OnInit {

    isLoggedIn: boolean = false;

    @Input()
    public user: User;

    title = "";
    subtitle = "";

    constructor(private authService: AuthService) {
        //
    }

    ngOnInit() {
        this.authService.isLoggedIn.subscribe(this.onLoginStatusChange);
    }

    onLoginStatusChange = (response) => {
        this.isLoggedIn = response;
    };
}
