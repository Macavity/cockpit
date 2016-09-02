/*
 * Angular bootstraping
 */
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { decorateModuleRef } from './environment';
import { ApplicationRef } from '@angular/core';

/*
 * App Module
 * our top level module that holds all of our components
 */
import { AppModule } from './app/app.module';

/*
 * Bootstrap our Angular app with a top level NgModule
 */
export function main(): Promise<any> {
    return platformBrowserDynamic()
        .bootstrapModule(AppModule)
        .then(decorateModuleRef)
        .catch(err => console.error(err));

}

platformBrowserDynamic().bootstrapModule(AppModule);
