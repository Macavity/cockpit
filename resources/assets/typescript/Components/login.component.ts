
import { Component } from "@angular/core";
import { Router, RouterLink } from '@angular/router-deprecated';
import { CORE_DIRECTIVES, FORM_DIRECTIVES, FormBuilder, Validators} from "@angular/common";
import { Http, Headers } from "@angular/http";
import { UserService } from "../services/user.service";

@Component(<any> {
    selector: 'login-page',
    templateUrl: '/templates/login',
    directives: [ RouterLink, CORE_DIRECTIVES, FORM_DIRECTIVES ]
})
export class LoginComponent {
    constructor(public router: Router, public http: Http, private userService: UserService) { }

    hasEmailError = false;
    hasGenericError = false;
    errorMessage = "";

    login(event, email, password) {
        event.preventDefault();

        this.userService.authenticate(email, password)
            .then(
                response => {
                    console.log("success authenticating => redirect");
                    localStorage.setItem('jwt', response.json().token);
                    this.router.parent.navigateByUrl('/dashboard');
                },
                error => {
                    console.warn("error logging in!");

                    const errorType = error.json().error || "default";

                    if (errorType == "invalid_credentials") {
                        this.hasEmailError = true;
                    } else {
                        this.hasGenericError = true;
                        this.errorMessage = error.json().message;
                    }
                }
            );
    }
}
