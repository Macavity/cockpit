import { inject, TestBed } from '@angular/core/testing';
import { ApiService } from './api.service.ts';
import { BaseRequestOptions, Response, ResponseOptions, Http, ConnectionBackend } from '@angular/http';
import { MockBackend, MockConnection } from "@angular/http/testing";
import { AuthHttp, AuthConfig } from "angular2-jwt";

describe('Api Service', () => {
    beforeEach(() => {
        TestBed.configureTestingModule({
            providers: [
                ApiService,
                BaseRequestOptions,
                MockBackend,
                {
                    provide: Http,
                    useFactory: (backend: ConnectionBackend, defaultOptions: BaseRequestOptions) => {
                        return new Http(backend, defaultOptions);
                    },
                    deps: [ MockBackend, BaseRequestOptions ]
                },
                {
                    provide: AuthHttp,
                    useFactory: (http) => {
                        return new AuthHttp(new AuthConfig(), http);
                    },
                    deps: [ Http ]
                }
            ]
        });
    });

    beforeEach(inject([MockBackend], (backend: MockBackend) => {
        const baseResponse = new Response(new ResponseOptions({ body: 'got response' }));
        backend.connections.subscribe((c: MockConnection) => c.mockRespond(baseResponse));
    }));

    it('should return response',
        inject([ApiService], (apiService: ApiService) => {
            apiService.get('/')
                .then(
                    (res: Response) => {
                        expect(res.text()).toBe('got response');
                    }
                );
        })
    );
});
