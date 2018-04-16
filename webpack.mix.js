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
 
 // mix.copy('node_modules/vue/dist/vue.min.js', 'resources/assets/js/lib/vue.js');
 // 	.copy('node_modules/axios/dist/axios.min.js', 'resources/assets/js/lib/axios.js');

mix.js('resources/assets/js/app.js', 'public/js')
	.sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
    'public/js/app.js'
], 'public/js/all.js');

mix.version(['public/css/app.css', 'public/js/all.js']);
