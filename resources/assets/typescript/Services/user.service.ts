
import { Injectable } from "@angular/core";
import { Http, Headers } from "@angular/http";
//import localStorage from "localStorage";
import {ApiService} from "./api.service";
import {User} from "../common/user";

@Injectable()
export class UserService {
    private loggedIn = false;

    constructor(private http: Http, private api: ApiService) {
        this.loggedIn = !!localStorage.getItem('jwt');
    }

    public logout() {
        localStorage.removeItem('jwt');
        this.loggedIn = false;
    }

    public isLoggedIn() {
        return this.loggedIn;
    }

    public authenticate(email, password) {
        return this.api.post('/api/authenticate', { email, password });
    }

    public getCurrentUser(): Promise<User> {
        return this.api.getSecure('currentUser');
    }

    public getUser(id: number): Promise<User> {
        return this.api.getSecure('user/' + id)
            .then(
                response => {
                    return new User(<User> response);
                }
            );
    }

    /**
     * Delete existing user
     * @param user
     * @returns {any}
     */
    public delete(user: User) {
        return this.api.deleteSecure('user/' + user.id)
            .then(response => {
                console.log("delete user done");
            });
    }

    /**
     * Update existing user
     *
     * @param user
     * @returns {any}
     */
    public put(user: User) {
        return this.api.putSecure('user', JSON.stringify(user))
            .then(response => {
                console.log("put user done");
            });
    }
}