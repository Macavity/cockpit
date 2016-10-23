import { inject, async, fakeAsync, tick, ComponentFixture, TestBed } from '@angular/core/testing';
import { LoginComponent } from "./login.component";
import { Router } from "@angular/router";
import { AuthService } from "../../services/auth.service";

class MockAuthService {
    public isLoggedIn: boolean = false;
    private token: string;

    login(email, password) {
        this.isLoggedIn = true;
        this.token = "new-token";
        return Promise.resolve(true);
    }
}

describe('LoginComponent', function () {

    beforeEach(function () {
        TestBed.configureTestingModule({
            declarations: [ LoginComponent ],
            providers: [
                {
                    provide: AuthService,
                    useClass: MockAuthService
                }
            ]
        });
    });

    it('should display a login form if not logged in', async(() => {

        TestBed.compileComponents().then(() => {
            let fixture = TestBed.createComponent(LoginComponent);
            fixture.detectChanges();

            let compiled = fixture.debugElement.nativeElement;
            expect(compiled).toBeDefined();
            expect(compiled.querySelector('.login-form__header').innerText).toContain("Login to your account");
        });

    }));

    it('should contain a link to the password-reset page', function () {
        TestBed.compileComponents().then(() => {
            let fixture = TestBed.createComponent(LoginComponent);
            fixture.detectChanges();

            let compiled = fixture.debugElement.nativeElement;
            const passwordLink = compiled.querySelector('.login-form__forgot');
            expect(passwordLink.innerText).toContain("Forgot Password?");
            expect(passwordLink).toContain("Forgot Password?");
        });

    });
});
