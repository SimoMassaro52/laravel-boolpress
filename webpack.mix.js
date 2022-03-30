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
//Modifichiamo i webpack in modo che riconoscano i nomi delle risorse che abbiamo rinominatos

mix.js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css');

mix.js('resources/js/front.js', 'public/js')
.sass('resources/sass/front.scss', 'public/css');
