import { Component } from '@angular/core'
import { Router } from '@angular/router-deprecated';
//import { ROUTER_DIRECTIVES } from '@angular/router'
import { Location } from '@angular/common';

declare var jQuery: any;

@Component({
    selector: 'main-navbar',
    templateUrl: '/templates/partials.navbar',
    directives: [ ]
})
export class NavbarComponent {

    isGuest = true;
    isUser = false;

    constructor(private location: Location) {}
    
    public toggleSidebar():void {

        //If window is small enough, enable sidebar push menu
        if (jQuery(window).width() <= 992) {
            jQuery('.row-offcanvas').toggleClass('active');
            jQuery('.left-side').removeClass("collapse-left");
            jQuery(".right-side").removeClass("strech");
            jQuery('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            jQuery('.left-side').toggleClass("collapse-left");
            jQuery(".right-side").toggleClass("strech");
        }
    }
    
}
