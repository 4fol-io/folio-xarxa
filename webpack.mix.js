/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

let mix = require('laravel-mix')


//const proxy = "localhost"
const proxy = "https://folio.local"

const config = {
    externals: {
      jquery: "jQuery"
    },
    /*stats: {
        children: true,
    },*/
}

const options = {
    processCssUrls: false,
    postCss: [require('autoprefixer')]
}

/*
 |--------------------------------------------------------------------------
 | CONFIGURATION
 |--------------------------------------------------------------------------
 */
mix
    .webpackConfig( config )
    .setPublicPath( "./dist" )
    .disableNotifications()
    .options( options )
    .sourceMaps( mix.inProduction(), 'source-map' )

      
/*
 |--------------------------------------------------------------------------
 | COMPILE JS & CSS
 |--------------------------------------------------------------------------
 */
mix
    .js('src/js/app.js', 'dist/js/')
    .js('src/js/customizer.js', 'dist/js/')
    .extract()
    .sass('src/scss/style.scss', 'dist/css/')
    .sass('src/scss/admin.scss', 'dist/css/admin.css')
    .sass('src/scss/editor-styles.scss', 'dist/css/editor-styles.css')
    .sass('src/scss/editor-blocks.scss', 'dist/css/editor-blocks.css')
    .version()
  

/*
 |--------------------------------------------------------------------------
 | COPY ASSETS
 |--------------------------------------------------------------------------
 */
mix
    .copyDirectory("src/images", "dist/images")
    //.copyDirectory("src/fonts", "dist/fonts")


/*
 |--------------------------------------------------------------------------
 | BROWSERSYNC
 |--------------------------------------------------------------------------
 */
mix
    .browserSync({
        proxy: proxy,
        open: false,
        files: [
            'dist/**/*.{css,js}',
            'templates/**/*.php'
        ]
    })
