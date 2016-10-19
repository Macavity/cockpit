# Laravel Angular2 Helpdesk/Project Management Cockpit

## Installation:

1. Install PHP Packages with `composer install`
2. Install NPM Packages with `npm install`
3. Setup Environment: Create `.env` file (Based on `.env.example`)
4. Setup Laravel Keys with `php artisan key:generate`
5. Download Typings with `npm run typings`


## Commands

* Build: `gulp`
* Watching: `gulp watch`
* Server: `php artisan serve`

## Info

* `resources/views/backend` - views for every page **except** Angular 2 templates
* `resources/views/frontend` - views **only** for Angular 2 templates (Components, Directives)

## Development server
Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive/pipe/service/class`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `-prod` flag for a production build.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/). 
Before running the tests make sure you are serving the app via `ng serve`.

## Deploying to Github Pages

Run `ng github-pages:deploy` to deploy to Github Pages.
