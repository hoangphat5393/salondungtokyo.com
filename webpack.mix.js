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

let productionSourceMaps = false;
let LoaderDirs = { images: 'assets/images', fonts: 'assets/fonts' };

mix.sass('resources/sass/style.scss', 'public/assets/css')
    .options({
        fileLoaderDirs: LoaderDirs,
    })
    .sourceMaps(productionSourceMaps, 'source-map');

mix.disableSuccessNotifications();
