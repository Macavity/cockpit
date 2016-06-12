import { Component } from '@angular/core';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Router } from '@angular/router-deprecated';

import {NavbarComponent} from "./navbar.component";

@Component({
    selector: 'header',
    templateUrl: '/templates/partials.header',
    directives: [
        <any> NavbarComponent
    ]
})
export class HeaderComponent {
    
    constructor() {}

}
