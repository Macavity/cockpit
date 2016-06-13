import { Injectable }     from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import { Observable }     from 'rxjs/Observable';
import 'rxjs';
import 'rxjs/add/operator/toPromise';

import { contentHeaders } from "../common/headers";

@Injectable()
export class ApiService {

    jwt: string;

    constructor(private http: Http) {

        this.jwt = localStorage.getItem('jwt');

    }

    get(action: string) {
        return this.http.get('/api/' + action);
    }

    getSecure(action: string): Promise<any> {
        //headers.append('Authorization', `Bearer ${this.jwt}`);

        //noinspection TypeScriptUnresolvedFunction
        return this.http.get('/api/' + action + "?token=" + this.jwt, { headers: contentHeaders })
            .toPromise()
            .then((response: Response) => response.json().data)
            .catch(this.handleError);
    }

    post(action: string, data: Object): Promise<any> {
        //noinspection TypeScriptUnresolvedFunction
        return this.http.post('/api/' + action, JSON.stringify(data), contentHeaders)
            .toPromise()
            .then()
            .catch(this.handleError);
    }

    postSecure(action: string, data: Object): Promise<any> {
        //noinspection TypeScriptUnresolvedFunction
        return this.http.post('/api/' + action + "?token=" + this.jwt, JSON.stringify(data), contentHeaders)
            .toPromise()
            .then()
            .catch(this.handleError);
    }

    putSecure(action: string, data: Object) {
        //noinspection TypeScriptUnresolvedFunction
        return this.http.put('/api/' + action + "?token=" + this.jwt, JSON.stringify(data), contentHeaders)
            .toPromise()
            .then()
            .catch(this.handleError);
    }

    deleteSecure(action: string) {
        //noinspection TypeScriptUnresolvedFunction
        return this.http.delete('/api/' + action + "?token=" + this.jwt, contentHeaders)
            .toPromise()
            .then()
            .catch(this.handleError);
    }

    handleError(error) {

        const errorType = error.json().error;

        if (errorType == "token_expired") {
            localStorage.removeItem(('jwt'));
            window.location.href = "/login";
        }

        console.error(error);
        return Promise.reject(error.message || error);
    }
}