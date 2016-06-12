import { Component } from '@angular/core';
import { Router } from '@angular/router-deprecated';
//import { ROUTER_DIRECTIVES } from '@angular/router';
import { Location } from '@angular/common';

@Component({
    selector: 'footer',
    templateUrl: '/templates/partials.footer',
    directives: [ ]
})
export class FooterComponent {
    constructor(private location: Location) {}
}
