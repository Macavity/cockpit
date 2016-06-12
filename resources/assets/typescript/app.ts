import { bootstrap }    from '@angular/platform-browser-dynamic';

import { FORM_PROVIDERS } from "@angular/common";
import { ROUTER_PROVIDERS } from '@angular/router-deprecated';
import { Http, HTTP_PROVIDERS } from '@angular/http';
import { provide, enableProdMode } from '@angular/core';
import { AuthConfig, AuthHttp } from "angular2-jwt";

import { AppComponent } from './components/app.component.ts';

//enableProdMode();
bootstrap(
    <Function> AppComponent,
    [
        FORM_PROVIDERS,
        ROUTER_PROVIDERS,
        HTTP_PROVIDERS,
        provide(AuthHttp, {
            useFactory: (http) => {
                return new AuthHttp(new AuthConfig({
                    tokenName: 'jwt'
                }), http);
            },
            deps: [Http]
        })
    ]
);