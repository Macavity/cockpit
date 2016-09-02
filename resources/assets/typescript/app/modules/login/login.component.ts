
import { Component } from "@angular/core";

import { AuthService } from "../../services/auth.service";

@Component(<any> {
    selector: 'page-login',
    template: require('./login.html'),
    styles: [`
    .login-form {
        width: 320px;
        margin: 0 auto 20px;
    }
    `]
})
export class LoginComponent {
    public submitted: boolean = false;

    public email: string = "";
    public password: string = "";

    public hasLoginError = false;
    public hasGenericError = false;
    public errorMessage = "";

    constructor(
        private authService: AuthService
    ) {
        //
    }

    login(event, email, password) {
        event.preventDefault();

        this.submitted = true;

        this.authService.login(email, password)
            .then(
                response => {
                    console.log("Login succeeded");
                }
            )
            .catch(
                error => {
                    console.warn("Login Error!");

                    const errorType = error.json().error || "default";

                    if (errorType == "invalid_credentials") {
                        this.hasLoginError = true;
                    } else {
                        this.hasGenericError = true;
                        this.errorMessage = error.json().message;
                    }

                }
            );
    }
}
