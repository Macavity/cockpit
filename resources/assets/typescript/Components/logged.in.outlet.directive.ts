import { Directive, Attribute, ViewContainerRef, DynamicComponentLoader } from "@angular/core";
import { Router, RouterOutlet, ComponentInstruction } from "@angular/router-deprecated";

@Directive({
    selector: 'router-outlet'
})
export class LoggedInRouterOutlet extends RouterOutlet{

    publicRoutes: any;

    constructor(
            private viewContainerRef: ViewContainerRef,
            private loader: DynamicComponentLoader,
            private parentRouter: Router,
            @Attribute('name') nameAttr: string ) {
        super(viewContainerRef, loader, parentRouter, nameAttr);

        this.publicRoutes = {
            'login': true
        };
    }

    activate(instruction: ComponentInstruction) {
        let url = instruction.urlPath;
        if (!this.publicRoutes[url] && !localStorage.getItem('jwt')) {
            this.parentRouter.navigateByUrl('/login');
        }

        return super.activate(instruction);
    }
}