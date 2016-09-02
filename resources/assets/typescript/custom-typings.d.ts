/*
 * Custom Type Definitions
 * When including 3rd party modules you also need to include the type definition for the module
 * if they don't provide one within the module. You can try to install it with typings

 typings install dt~node --save --global

 * If you can't find the type definition in the registry we can make an ambient definition in
 * this file for now. For example

 declare module "my-module" {
 export function doesSomething(value: string): string;
 }

 *
 * If you're prototying and you will fix the types later you can also declare it as type any
 *

 declare var assert: any;
 declare var _: any;
 declare var $: any;

 *
 * If you're importing a module that uses Node.js modules which are CommonJS you need to import as
 *

 import * as _ from 'lodash'

 * You can include your type definitions in this file until you create one for the typings registry
 * see https://github.com/typings/registry
 *
 */

declare var __moduleName:any;

interface Window {
    APP_ENVIRONMENT: {
        APP_ENV: string;
        API_STANDARDS_TREE: string;
        API_SUBTYPE: string;
        API_VERSION: string;
    }
    Laravel: {
        csrfToken: string;
    };
}

interface GlobalEnvironment {
    ENV;
}

interface ErrorStackTraceLimit {
    stackTraceLimit: number;
}

// Extend typings
interface ErrorConstructor extends ErrorStackTraceLimit {}
interface Global extends GlobalEnvironment  {}
