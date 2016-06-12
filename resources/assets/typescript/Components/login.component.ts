
import { Component } from "@angular/core";
import { Router, RouterLink } from '@angular/router-deprecated';
import { CORE_DIRECTIVES, FORM_DIRECTIVES, FormBuilder, Validators} from "@angular/common";
import { Http, Headers } from "@angular/http";
import { contentHeaders } from "../common/headers";

@Component(<any> {
    selector: 'login-page',
    templateUrl: '/templates/login',
    directives: [ RouterLink, CORE_DIRECTIVES, FORM_DIRECTIVES ]
})
export class LoginComponent {
    constructor(public router: Router, public http: Http) { }

    login(event, username, password) {
        event.preventDefault();

        let body = JSON.stringify({ username, password });

        this.http.post('/api/authenticate', body, {
            headers: contentHeaders
        })
        .subscribe(
            response => {
                localStorage.setItem('jwt', response.json().token);
                this.router.parent.navigateByUrl('/dashboard');
            },
            error => {
                alert(error.text());
                console.log(error.text());
            }
        );
    }
}
