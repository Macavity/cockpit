import { Component, OnInit, Input } from '@angular/core';
import { Location } from '@angular/common';

import { UserService } from "../../services/user.service";
import { User } from "../../common/user";
import { Language } from "../../common/language";
import { AuthService } from "../../services/auth.service";
import { NavigationEntry } from "./navigation.model";
import { NavigationService } from "./navigation.service";
import { LanguageService } from "../../services/language/language.service";

@Component({
    selector: 'main-navbar',
    template: require('./navbar.html'),
})
export class NavbarComponent {

    public isLoggedIn: boolean = false;

    @Input()
    public user: User;

    languages: Language[] = [];
    currentLanguage: Language;

    private topnav: NavigationEntry[];
    private topnavRight: NavigationEntry[];

    constructor(
        private authService: AuthService,
        private userService: UserService,
        private navigationService: NavigationService,
        private languageService: LanguageService
    ) {

        // User
        this.isLoggedIn = this.authService.isAuthenticated();
        this.user = new User();

        // Localization
        this.languages = this.languageService.getLanguages();
        this.currentLanguage = this.languageService.getCurrentLanguage();

        // Navigation Elements
        this.topnav = this.navigationService.topnav;
        this.topnavRight = this.navigationService.topnavRight;
    }

    logout() {
        this.authService.logout();
    }

    changeLanguage(lang: Language) {
        console.log("clicked on changeLanguage");
    }

}
