const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/backend.js', 'public/js/backend')
    .js('resources/js/frontend.js', 'public/js/frontend')
    .sass('resources/sass/backend/style.scss', 'public/css/backend')
    .sass('resources/sass/frontend/style.scss', 'public/css/frontend');
