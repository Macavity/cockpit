import { Component } from '@angular/core';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Router } from '@angular/router-deprecated';

import {NavbarComponent} from "./navbar.component";
import {UserService} from "../../services/user.service";

@Component({
    selector: 'header',
    templateUrl: '/templates/partials.header',
    directives: [
        <any> NavbarComponent
    ]
})
export class HeaderComponent {

    isUser = false;
    isGuest = false;

    constructor(private userService: UserService) {
        this.isGuest = !this.userService.isLoggedIn();
        this.isUser = this.userService.isLoggedIn();
    }

}
