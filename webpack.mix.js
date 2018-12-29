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

    mix.js('resources/assets/js/app.js', 'public/js/app.js');

    //para mezclar
   //  mix.scripts(['public/js/app.js','resources/assets/js/prueba.js'], 'public/js/all.js');
   mix.sass('resources/sass/app.scss', 'public/css');

//    mix.browserSync({
//        proxy: 'localhost',
//    });
 //  mix.scripts(['public/js/app.js', 'resources/assets/js/prueba.js'], 'public/js/all.js')


   
//    mix.styles([
//     'public/css/a.css',
//     'public/css/b.css',
//     'public/css/c.css'
//    ], 'public/css/all.css');

   //  o
   // mix.less('resources/less/style.less', 'public/css');

   //Para conbinar varios estilos css se usa
   