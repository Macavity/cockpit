import { Injectable }     from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable }     from 'rxjs/Observable';
import 'rxjs';

import {Dashboard} from "./dashboard";

@Injectable()
export class DashboardService {

    constructor(private http: Http) { }
    
    private url = '/dashboard';
    
    getDashboard(): Observable<Dashboard[]> {
        return this.http.get(this.url)
            .map(this.extractData)
            .catch(this.handleError);
    }
    
    private extractData(res: Response) {
        console.log(res.json());
        return res.json();
    }
    
    private handleError(error: any) {
        
        let errMsg = (error.message) ? error.message :
            error.status ? `${error.status} - ${error.statusText}` : 'Server error';
            
        return Observable.throw(errMsg);
    }
}
