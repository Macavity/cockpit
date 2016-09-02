//process.env.DISABLE_NOTIFIER = true;

var Elixir = require('laravel-elixir');
var path = require('path');
var webpack = require('webpack');

require('laravel-elixir-webpack-ex');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var Task = Elixir.Task;


/**
 * Custom Elixir Task to copy vendor libraries
 * (only during development)
 */
Elixir.extend('vendor', function (src, output) {

    var paths = new Elixir.GulpPaths().src(src).output(output);

    new Task('vendor', function ($) {
        this.recordStep("Copy Vendor Libraries");

        return gulp.src(paths.src.path, {base: './node_modules/'})
            .pipe(gulp.dest(paths.output.path));
    }, paths).watch('package.json');


});

Elixir(function(mix) {

    /**
     * App CSS
     **/
    mix.sass('app.scss');

    mix.sass('themes/**/*.scss', 'public/css/themes/');

    /**
     * Bootstrap
     */
    var bootstrapPath = 'node_modules/bootstrap';

    mix.copy(bootstrapPath + '/dist/css/bootstrap.min.css', 'public/css');
    mix.copy(bootstrapPath + '/dist/js/bootstrap.min.js', 'public/js');
    mix.copy(bootstrapPath + '/dist/fonts', 'public/fonts');

    /**
     * Copy assets
     */
    mix.copy('resources/assets/fonts', 'public/fonts');
    mix.copy('resources/assets/css', 'public/css');
    mix.copy('resources/assets/images', 'public/images');

    // Copy Angular templates
    mix.copy('resources/assets/typescript/**/*.html', 'public/js/');

    /**
     * Copy vendor assets
     */
    var libs = [
        'node_modules/reflect-metadata/Reflect.js',
        'node_modules/reflect-metadata/Reflect.js.map',
        'node_modules/zone.js/dist/zone.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/font-awesome/css/font-awesome.min.css',
        'node_modules/font-awesome/fonts/',
    ];
    mix.vendor(libs, 'public/vendor/');


    /**
     * Scripts webpack bundling and copying
     **/
    mix.webpack({
        vendor: 'vendor.ts',
        main: 'app.ts'
    }, {
        debug: true,
        devtool: 'source-map',
        resolve: {
            extensions: ['', '.ts', '.js']
        },
        module: {
            loaders: [
                {
                    test: /\.ts$/,
                    loader: 'awesome-typescript-loader',
                    exclude: [
                        /\.(spec|e2e)\.ts$/,
                        /\.d\.ts$/,
                        /node_modules/,
                        /typings/,
                        /public/,
                    ]
                },
                {
                    test: /\.html$/,
                    loader: 'raw-loader',
                },
            ]
        },
        plugins: [
            new webpack.ProvidePlugin({
                '__decorate': 'typescript-decorate',
                '__extends': 'typescript-extends',
                '__param': 'typescript-param',
                '__metadata': 'typescript-metadata'
            }),
            new webpack.optimize.CommonsChunkPlugin({
                name: 'vendor',
                filename: 'vendor.js',
                minChunks: Infinity
            }),
            new webpack.optimize.CommonsChunkPlugin({
                name: 'main',
                filename: 'main.js',
                minChunks: 4,
                chunks: [
                    'main'
                ]
            }),
            /*new webpack.optimize.UglifyJsPlugin({
             compress: {
             warnings: false
             },
             minimize: true,
             mangle: false
             })*/
        ]
    }, 'public/js', 'resources/assets/typescript');

    mix.browserSync({
        proxy: process.env.BROWSERSYNC_PROXY_URL
    });

});
