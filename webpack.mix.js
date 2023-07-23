// webpack.mix.js

let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
mix.copy('resources/js/delete.js', 'public/js')
    .setPublicPath('public/js');
