
import { Injectable } from "@angular/core";
import { Http, Headers, Response } from "@angular/http";
import { BehaviorSubject } from 'rxjs/Rx';

import { ApiService } from "./api.service";
import { User } from "../common/user";

@Injectable()
export class UserService {

    public currentUser: User;

    constructor(private api: ApiService) {
    }

    public getCurrentUser(): Promise<User> {
        return this.api.authGet('currentUser');
    }

    public getUser(id: number): Promise<User> {
        return this.api.authGet('user/' + id)
            .then(
                response => {
                    return new User(<User> response);
                }
            );
    }
}
