let mix = require('laravel-mix')
// require('laravel-mix-criticalcss');
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
// Transpila Todos los estilos y los envia a public
mix.stylus('devsrc/src/styles/estilos.styl', 'public/css', {
  use: [
    require('rupture')(),
    require('nib')()
  ],
  import: [
    '~nib/index.styl'
  // '~flexboxgrid/css/index.css',
  ]
})
  .options({
    processCssUrls: false,
    postCss: [
      require('autoprefixer')({
        browsers: ['last 2 versions'],
        cascade: false
      }),
      require('postcss-move-media')()
  // require("css-mqpacker")()
    ]
  }).version()
// mix.stylus('devsrc/src/styles/error_404.styl', 'public/css', {
//   use: [
//     require('rupture')(),
//     require('nib')()
//   ],
//   import: [
//     '~nib/index.styl'
//   ]
// })
  .options({
    processCssUrls: false,
    postCss: [
      require('autoprefixer')({
        browsers: ['last 2 versions'],
        cascade: false
      }),
      require('postcss-move-media')()
    ]
  }).version()
// versiona todos los bundles que existen e la carpeta dist, se agregaron los que tienen mas cambios constantemente.
// mix.copy(['devsrc/dist/js/app.bundle.js',
//   // 'devsrc/dist/js/booking.bundle.js',
//   // 'devsrc/dist/js/bookingPaqueteUsa.bundle.js',
//   // 'devsrc/dist/js/bookingUsa.bundle.js',
//   'devsrc/dist/js/common.bundle.js',
//   // 'devsrc/dist/js/payment.bundle.js'
//   ], 'public/js')
// .version()
