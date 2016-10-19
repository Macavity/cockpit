
import { Injectable } from "@angular/core";
import { BehaviorSubject } from "rxjs/Rx";
import { Response } from "@angular/http";
import { ApiService } from "./api.service";
import { tokenNotExpired, IAuthConfig } from "angular2-jwt";

export const TOKEN_NAME = 'token';

@Injectable()
export class AuthService {

    private token: string;


    public isLoggedIn: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

    constructor(
        private api: ApiService,
    ) {
        this.token = localStorage.getItem(TOKEN_NAME) || null;

        this.isLoggedIn.next(this.isAuthenticated())
    }

    public isAuthenticated(): boolean {
        return tokenNotExpired(TOKEN_NAME);
    }

    public static getAuthConfig(): IAuthConfig {
        return {
            headerName: 'Authorization',
            headerPrefix: 'Bearer',
            tokenName: TOKEN_NAME,
            tokenGetter: (() => localStorage.getItem(TOKEN_NAME)),
            globalHeaders: [{ 'Content-Type':'application/json' }],
            noJwtError: true
        }
    }

    public static getToken(): string {
        return localStorage.getItem(TOKEN_NAME);
    }

    login(email, password): Promise<boolean> {
        return this.api.post('authenticate', { email, password })
            .then(
                (response: Response) => {
                    // login successful if there's a jwt token in the response
                    let token = response.json() && response.json().token;

                    if (token) {
                        // set token property
                        this.token = token;

                        // store username and jwt token in local storage to keep user logged in between page refreshes
                        localStorage.setItem(TOKEN_NAME, token);
                        this.isLoggedIn.next(true);

                        return true;
                    } else {
                        // return false to indicate failed login
                        return false;
                    }
                }
            );
    }

    public logout() {
        this.token = null;
        localStorage.removeItem(TOKEN_NAME);
        this.isLoggedIn.next(false);
    }
}
