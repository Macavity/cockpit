import { Component } from '@angular/core';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Router } from '@angular/router-deprecated';
import { Location } from '@angular/common';

import {FooterComponent} from "./footer.component";

@Component({
    selector: 'content',
    templateUrl: '/templates/partials.content',
    directives: <any> [ FooterComponent ]
})
export class ContentComponent {
    constructor(private location: Location) {}
}
