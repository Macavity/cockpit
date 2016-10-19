import { Injectable }     from '@angular/core';
import { Response } from '@angular/http';
import { Observable }     from 'rxjs/Observable';
import 'rxjs';

import {Dashboard} from "./dashboard";
import { ApiService } from "../../services/api.service";

@Injectable()
export class DashboardService {

    constructor(private api: ApiService) { }

    getDashboard(): Promise<Dashboard> {
        return this.api.authGet('dashboard')
            .then(
                (response) => {
                    console.log("DashboardService.getDashboard -> response");
                    return new Dashboard(response);
                }
            );
    }

    private handleError(error: any) {

        let errMsg = (error.message) ? error.message :
            error.status ? `${error.status} - ${error.statusText}` : 'Server error';

        return Observable.throw(errMsg);
    }
}
