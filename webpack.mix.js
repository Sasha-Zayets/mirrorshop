let mix = require('laravel-mix');

mix

//--------------------------admin-panel-----------------------------------------

    // .sass('./resources/assets/admin/scss/style.scss', 'public/admin/css')
    // .sass('./resources/assets/admin/scss/text-pages/style.scss', 'public/admin/css/text-pages.css')

    //--------------------------------------------------------------------------------

    .sass('./resources/admin/assets/scss/app.scss', 'public/admin/css')
    .copyDirectory('./resources/admin/static', 'public/static')
    .copyDirectory('./resources/admin/assets/scss/login.css', 'public/admin/css')
    .options({
        processCssUrls: false,
    })
    .js('./resources/admin/app.js', 'public/admin/js')
    
    .version()

    .browserSync({
        proxy: 'http://svitdzerkal.com.ua.wm/wmpanel/',
        host: 'svitdzerkal.com.ua.wm',
        open: 'external',
        files: [
            './public/static',
            './public/admin/js/app.js',,
            './public/admin/css/app.css',
        ],
    })

if(!mix.inProduction()) { mix.webpackConfig({devtool: 'source-map'}).sourceMaps(); }
