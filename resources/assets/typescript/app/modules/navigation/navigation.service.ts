
import { Input, Injectable } from "@angular/core";
import { Navigation, NavigationCategory, NavigationEntry } from './navigation.model';
import { UserService } from '../../services/user.service';
import { AuthService } from "../../services/auth.service";

/**
 * NavigationService
 * - TODO Make Navigation configurable by client installation
 * - TODO Make Navigation entries configurable by user role
 */
@Injectable()
export class NavigationService {

    topnav: NavigationEntry[];
    topnavRight: NavigationEntry[];
    sidebar: NavigationEntry[];

    constructor(
        private authService: AuthService
    ) {

        // TODO: Check activated modules and load navigation for each module

        this.topnav = [
            new NavigationEntry("Dashboard", "/dashboard"),

            new NavigationEntry("Courses", "/courses"),

        ];

        if(this.authService.isLoggedIn.getValue()) {

        }
        else {

        }


    }
}
