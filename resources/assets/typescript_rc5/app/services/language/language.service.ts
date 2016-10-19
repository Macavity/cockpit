import { Injectable } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';

import { Observable } from 'rxjs/Observable';
import 'rxjs';
import 'rxjs/add/operator/toPromise';

import { ApiService } from '../api.service';
import { Language } from './language.model';

@Injectable()
export class LanguageService {

    endpoint: string = '/api/language';

    private languages: Language[] = [];

    private currentLanguage: Language;

    constructor(private http: Http, private api: ApiService) {
        this.languages.push(new Language('en', 'English', '/images/flags/us.png'));
        this.languages.push(new Language('de', 'Deutsch', '/images/flags/de.png'));

        this.currentLanguage = this.getDefaultLanguage();
    }

    public getLanguages(): Language[] {
        return this.languages;
    }

    public getDefaultLanguage(): Language {
        return this.languages[0];
    }

    public getCurrentLanguage(): Language {
        return this.currentLanguage;
    }

    public changeLanguage(lang: Language) {
        this.currentLanguage = lang;
        // TODO Save switched language to user
    }
}
