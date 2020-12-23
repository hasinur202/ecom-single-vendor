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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');


// mix.styles([
//     'resources/plugins/fontawesome-free/css/all.min.css',
//     'resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
//     'resources/dist/css/adminlte.min.css',
//     'resources/dist/css/dropzone.css',
//     // 'resources/icons.min.css',
//     'resources/plugins/datatables-bs4/css/dataTables.bootstrap4.css',
// ], 'public/css/app.css').version();


// mix.scripts([
//     'resources/plugins/jquery/jquery.min.js',
//     'resources/plugins/bootstrap/js/bootstrap.bundle.min.js',
//     'resources/dist/js/adminlte.min.js',
//     'resources/dist/js/dropzone.js',
//     'resources/plugins/datatables-bs4/js/dataTables.bootstrap4.js',
//     'resources/plugins/datatables/jquery.dataTables.js'
// ], 'public/js/app.js').version();
