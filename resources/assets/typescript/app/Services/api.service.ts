import { Injectable } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';

import { Observable } from 'rxjs/Observable';
import 'rxjs';
import 'rxjs/add/operator/toPromise';
import { AuthHttp } from "angular2-jwt";

@Injectable()
export class ApiService {
    jwt: string;

    endpoint: string = '/api/';

    private contentHeaders: Headers;

    constructor(private http: Http, private authHttp: AuthHttp)
    {
        this.contentHeaders = new Headers();
        this.contentHeaders.append('Accept', 'application/json');
        this.contentHeaders.append('Content-Type', 'application/json');
    }

    /**
     * Public GET
     * @param action
     * @returns {Observable<Response>}
     */
    get(action: string)
    {
        return this.http
            .get(this.endpoint + action)
            .toPromise();
    }

    /**
     * Public POST
     * @param action
     * @param data
     * @returns {Promise<any>}
     */
    post(action: string, data: Object): Promise<any>
    {
        return this.http
            .post(
                this.endpoint + action,
                JSON.stringify(data),
                { headers: this.contentHeaders }
            )
            .toPromise();
    }

    /**
     * Token secured GET
     * @param action
     * @returns {Promise<any>}
     */
    authGet(action: string): Promise<any>
    {
        return this.authHttp
            .get( this.endpoint + action )
            .toPromise();
    }

    /**
     * Token secured POST
     * @param action
     * @param data
     * @returns {Promise<any>}
     */
    authPost(action: string, data: Object): Promise<any>
    {
        return this.authHttp
            .post(
                this.endpoint + action,
                JSON.stringify(data)
            )
            .toPromise();
    }

    /**
     * Token secured PUT
     * @param action
     * @param data
     * @returns {Promise<any>}
     */
    authPut(action: string, data: Object = {}): Promise<any>
    {
        return this.authHttp
            .put(
                this.endpoint + action,
                JSON.stringify(data)
            )
            .toPromise();
    }

    /**
     * Token secured DELETE
     * @param action
     * @returns {Promise<any>}
     */
    authDelete(action: string): Promise<any>
    {
        return this.authHttp
            .delete(
                this.endpoint + action
            )
            .toPromise();
    }

    handleError(error = "") {
        console.log("error", error);

        /*if (errorType === "token_expired") {
         localStorage.removeItem(('auth_token'));
         window.location.href = "/login";
         }

         console.error(error);*/
        return Promise.reject(error);
    }
}
