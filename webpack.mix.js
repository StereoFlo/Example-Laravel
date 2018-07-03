let mix = require('laravel-mix');

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

//mix.js('engine/resources/assets/js/app.js', 'public/js').sass('engine/resources/assets/sass/app.scss', 'public/css');
mix.js([
    'static/js/common.js',
    'engine/resources/assets/js/app.js',
    //'static/js/manager.js',
    //'static/js/fileuploaderAvatar.js',
    //'static/js/fileuploaderWork.js',
], 'static/js//bundle.js');