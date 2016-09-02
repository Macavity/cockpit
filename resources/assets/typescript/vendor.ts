// Polyfills
//import 'es7-reflect-metadata/dist/browser';

// Zone.js
require('zone.js');

// Angular 2
import '@angular/common';
import '@angular/compiler';
import '@angular/core';
import '@angular/http';
import '@angular/platform-browser';
import '@angular/platform-browser-dynamic';
import '@angular/router';

// RxJS
import 'rxjs';

import { ENV } from "./environment";

if ('production' === ENV) {
    // Production

} else {
    // Development
}
