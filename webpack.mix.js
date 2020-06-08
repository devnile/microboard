const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

mix.disableSuccessNotifications()

    .setPublicPath('public')

    .copyDirectory('resources/vendor/nucleo', 'public/vendor/nucleo')
    .copyDirectory('resources/vendor/@fortawesome/fontawesome-free', 'public/vendor/@fortawesome')
    .copyDirectory('resources/vendor/jquery/dist', 'public/vendor/jquery')
    .copyDirectory('resources/vendor/bootstrap/dist/js', 'public/vendor/bootstrap')
    .copyDirectory('resources/vendor/js-cookie', 'public/vendor/js-cookie')
    .copyDirectory('resources/vendor/jquery.scrollbar', 'public/vendor/jquery.scrollbar')
    .copyDirectory('resources/vendor/jquery-scroll-lock/dist', 'public/vendor/jquery-scroll-lock')

    .js('resources/js/argon.js', 'public/js')

    .sass('resources/scss/argon.scss', 'public/css')
    .purgeCss({
        enabled: mix.inProduction(),
        folders: ['resources/views', 'resources/js'],
        extensions: ['html', 'php', 'vue', 'js'],
    })

    // for development only
    .copyDirectory('public', '../../public/vendor/microboard');
