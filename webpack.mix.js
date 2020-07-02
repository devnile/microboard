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

    .copyDirectory('resources/vendor/datatables.net/js', 'public/vendor/datatables.net')
    .copyDirectory('resources/vendor/datatables.net-bs4/js', 'public/vendor/datatables.net')
    .copyDirectory('resources/vendor/datatables.net-bs4/css', 'public/vendor/datatables.net')
    .copyDirectory('resources/vendor/datatables.net-buttons/js', 'public/vendor/datatables.net')
    .copyDirectory('resources/vendor/datatables.net-buttons/swf', 'public/vendor/datatables.net/swf')
    .copyDirectory('resources/vendor/datatables.net-buttons-bs4/js', 'public/vendor/datatables.net')
    .copyDirectory('resources/vendor/datatables.net-buttons-bs4/css', 'public/vendor/datatables.net')

    .copyDirectory('resources/vendor/sweetalert2/dist', 'public/vendor/sweetalert2')
    .copyDirectory('resources/vendor/dropzone/dist/min', 'public/vendor/dropzone')
    .copyDirectory('resources/vendor/select2/dist', 'public/vendor/select2')

    .js('resources/js/argon.js', 'public/js')

    .sass('resources/scss/argon.scss', 'public/css');
