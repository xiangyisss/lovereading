const mix = require('laravel-mix');
const path = require('path')

mix.ts('resources/js/app.ts', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .alias({
        '@': path.join(__dirname, 'resources/js/Pages'),
    });