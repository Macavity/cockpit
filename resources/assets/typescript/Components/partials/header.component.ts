import { Component } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';

import {NavbarComponent} from "./navbar.component";

@Component({
    selector: 'header',
    templateUrl: '/templates/partials.header',
    directives: [
        ROUTER_DIRECTIVES,
        <any>NavbarComponent
    ]
})
export class HeaderComponent {
    
    constructor() {}

}
