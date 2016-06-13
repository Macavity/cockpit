import { Directive, Attribute, ViewContainerRef, DynamicComponentLoader } from "@angular/core";
import { Router, RouterOutlet, ComponentInstruction } from "@angular/router-deprecated";
import {UserService} from "../services/user.service.ts";

@Directive({
    selector: 'router-outlet'
})
export class LoggedInRouterOutlet extends RouterOutlet {

    publicRoutes: string[];

    constructor(
            private viewContainerRef: ViewContainerRef,
            private loader: DynamicComponentLoader,
            private parentRouter: Router,
            @Attribute('name') nameAttr: string,
            private userService: UserService ) {
        super(viewContainerRef, loader, parentRouter, nameAttr);

        this.publicRoutes = ['login'];
    }

    activate(instruction: ComponentInstruction) {
        let url = instruction.urlPath;

        if (this.canActivate(url)) {
            return super.activate(instruction);
        }
        this.parentRouter.navigate(['/Login']);

    }

    /**
     * Checks if a route is accessible for the current visitor
     * @param url
     * @returns {boolean}
     */
    private canActivate(url) {
        return this.publicRoutes.indexOf(url) !== -1 || this.userService.isLoggedIn();
    }

}