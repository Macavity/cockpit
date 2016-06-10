import { Component } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { Location } from '@angular/common';

@Component({
    selector: 'footer',
    templateUrl: '/templates/partials.footer',
    directives: [ROUTER_DIRECTIVES]
})
export class FooterComponent {
    constructor(private location: Location) {}
}
