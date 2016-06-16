
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from "@angular/http";
import { BehaviorSubject } from 'rxjs/Rx';

import { ApiService } from "./api.service";
import { User } from "../common/user";

@Injectable()
export class UserService {
    public isLoggedIn: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

    public currentUser: User;

    constructor(private http: Http, private api: ApiService) {
        this.isLoggedIn.next(!!localStorage.getItem('jwt'));
    }

    public logout() {
        localStorage.removeItem('jwt');
        this.isLoggedIn.next(false);
    }

    public authenticate(email, password) {
        return this.api.post('authenticate', { email, password })
            .then(
                (response: Response) => {
                    this.isLoggedIn.next(true);
                    localStorage.setItem('jwt', response.json().token);
                }
            );
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