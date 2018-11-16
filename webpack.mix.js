var mix = require('laravel-mix'),
  copyWebpackPlugin = require('copy-webpack-plugin'),
  assetsDir = 'resources/assets/',
  /*langDir = 'resources/lang/',*/
  nodeDir = 'node_modules/',
  publicDir = 'public/',
  distDir = 'public/dist/',
  adminJs = [
    assetsDir + 'js/admin.js'
  ],
  applicationJs = [
    assetsDir + 'js/application.js',
  ];

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

const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
mix.webpackConfig({
  plugins: [
    new copyWebpackPlugin([
      { from: nodeDir    + 'tinymce', to: 'packages/tinymce' },
    ]),
    new BrowserSyncPlugin({
      open: 'external',
      host: 'scoreboard',
      proxy: 'scoreboard',
      files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
    })
  ]
});

mix
  .copy(nodeDir + 'wix-art-store-3rd-party/dist/statics/assets/locale/bc_email', langDir + 'wix-art-store-3rd-party')
  .copy(nodeDir + 'wix-art-store-3rd-party/dist/statics/assets/locale/bc', langDir + 'wix-art-store-3rd-party')
  .copy(nodeDir + 'font-awesome/fonts', publicDir + 'fonts')
  .sass(assetsDir + 'sass/admin.scss', distDir + 'css/admin.css').version()
  .sass(assetsDir + 'sass/application.scss', distDir + 'css/application.css').version()
  .sass(assetsDir + 'sass/application/proGallery/style.scss', distDir + 'css/progallery.css').version()
  .js(adminJs, distDir + 'js/admin.js').version()
  .js(applicationJs, distDir + 'js/application.js').version();

