import { Component } from '@angular/core'
import { ROUTER_DIRECTIVES } from '@angular/router'
import { Location } from '@angular/common';

declare var jQuery: any;

@Component({
    selector: 'navbar',
    templateUrl: '/templates/partials.navbar',
    directives: [ROUTER_DIRECTIVES]
})
export class NavbarComponent {
    
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
