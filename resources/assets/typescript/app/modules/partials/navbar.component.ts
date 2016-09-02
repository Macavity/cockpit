import { Component, OnInit } from '@angular/core';
import { Router, ROUTER_DIRECTIVES, ROUTER_PROVIDERS } from '@angular/router-deprecated';
//import { ROUTER_DIRECTIVES } from '@angular/router'
import { Location } from '@angular/common';

import { UserService } from "../../Services/user.service";
import { User } from "../../common/user";
import {Language} from "../../common/language";

@Component({
    selector: 'main-navbar',
    templateUrl: '/templates/partials.navbar',
    directives: [ ROUTER_DIRECTIVES ]
})
export class NavbarComponent implements OnInit {

    isLoggedIn = false;

    user: User;

    languages: Language[] = [];
    currentLanguage: Language;

    constructor(private location: Location, private userService: UserService) {

        this.user = new User();

        this.languages.push(new Language('en', 'English', '/images/flags/gb.png'));
        this.languages.push(new Language('de', 'Deutsch', '/images/flags/de.png'));
    }

    ngOnInit() {

        this.userService.isLoggedIn.subscribe(this.onLoginStatusChange);

        if (this.isLoggedIn) {
            console.log("is user => get user from service");
            this.userService.getCurrentUser()
                .then(response => {
                    console.log("navbar, user returned");
                    this.user = new User(response);
                    this.currentLanguage = this.languages[this.user.language];
                });
        }

    }

    onLoginStatusChange = (response) => {
        this.isLoggedIn = response;
    };

    logout() {
        this.userService.logout();
        window.location.href = "/login";
    }

    changeLanguage(lang: Language) {
        console.log("clicked on changeLanguage");
    }

}
