import { Component, OnInit } from '@angular/core';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Router } from '@angular/router-deprecated';

import { NavbarComponent } from "./navbar.component";
import { UserService } from "../../Services/user.service";

@Component({
    selector: 'header',
    templateUrl: '/templates/partials.header',
    directives: [
        <any> NavbarComponent
    ]
})
export class HeaderComponent implements OnInit {

    isLoggedIn: boolean = false;

    title = "";
    subtitle = "";

    constructor(private userService: UserService) {
        //
    }

    ngOnInit() {
        this.userService.isLoggedIn.subscribe(this.onLoginStatusChange);
    }

    onLoginStatusChange = (response) => {
        this.isLoggedIn = response;
    };
}
