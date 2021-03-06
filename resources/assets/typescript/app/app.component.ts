
import { Component, OnInit, Type, OnDestroy } from '@angular/core';
import { RouterModule, Router } from '@angular/router';

import { UserService } from './services/user.service';
import { User } from './common/user';
import { HeaderComponent } from './components/header.component';
import { BehaviorSubject } from 'rxjs';
import { AuthService } from './services/auth.service';
import { Response } from '@angular/http';

@Component({
    selector: 'app',
    template: require('./app.component.html'),
    directives: [
        HeaderComponent
    ],
    providers: [
        RouterModule
    ],
})
export class AppComponent implements OnInit, OnDestroy {

    public isLoggedIn: boolean = null;
    public isAdmin = false;

    public user: BehaviorSubject<User> = new BehaviorSubject<User>(new User());

    constructor(
        private authService: AuthService,
        private userService: UserService,
        private router: Router
    ) {
        // Check Login status initially
        this.onLoginStatusChange(this.authService.isAuthenticated());
    }

    ngOnInit(): void {
        this.authService.isLoggedIn.subscribe(this.onLoginStatusChange);
    }

    ngOnDestroy() {
        this.authService.isLoggedIn.unsubscribe();
    }

    /**
     * @callback
     * @param response
     */
    private onLoginStatusChange = (response) => {

        if (response === this.isLoggedIn) {
            return;
        }

        console.log('onLoginStatusChange', response);
        this.isLoggedIn = response;

        // Refresh the current user.
        if (this.isLoggedIn) {
            this.userService.getCurrentUser().then(
                (userdata) => {
                    this.user.next(new User(userdata));
                },
                (error: any) => {
                    //
                }
            );

            console.log('current url', this.router.url);
            if (this.router.url === '/login') {
                this.router.navigateByUrl('/dashboard');
            }

        } else {
            this.router.navigateByUrl('/login');
        }
    };

}
