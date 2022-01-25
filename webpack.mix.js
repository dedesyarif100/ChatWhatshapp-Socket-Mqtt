const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.styles([
    'public/assets/css/bootstrap.min.css',
    'public/assets/css/font-awesome.min.css',
    'public/assets/css/style.css',
    'public/assets/css/toastr.min.css'
], 'public/css/template.css').version();

mix.scripts([
    'public/assets/js/jquery-1.10.2.min.js',
    'public/assets/js/toastr.min.js'
], 'public/js/template.js').version();
