const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');
const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');
const rimraf = require('rimraf');
const del = require('del');
const fs = require('fs');

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

// Global jquery
mix.autoload({
    'jquery': ['$', 'jQuery'],
    Popper: ['popper.js', 'default'],
});

mix.options({
    cssNano: {
        discardComments: false,
    }
});

// Remove existing generated assets from public folder
del.sync(['public/css/*', 'public/js/*', 'public/media/*', 'public/plugins/*',]);

// Build 3rd party plugins css/js
mix.sass(`resources/assets/core/plugins/plugins.dark.scss`, `public/revo/plugins/global/plugins.bundle.css`).then(() => {
    // remove unused preprocessed fonts folder
    rimraf(path.resolve('public/fonts'), () => {
    });
    rimraf(path.resolve('public/images'), () => {
    });
}).sourceMaps(!mix.inProduction())
    // .setResourceRoot('./')
    .options({processCssUrls: false})
    .scripts(require('./resources/assets/core/plugins/plugins.js'), `public/revo/plugins/global/plugins.bundle.js`);

// Build extended plugin styles
mix.sass(`resources/assets/revo/sass/plugins.dark.scss`, `public/revo/plugins/global/plugins-custom.bundle.css`);

// Build Metronic css/js
mix.sass(`resources/assets/revo/sass/style.dark.scss`, `public/revo/css/style.bundle.css`, {sassOptions: {includePaths: ['node_modules']}})
    // .options({processCssUrls: false})
    .scripts(require(`./resources/assets/revo/js/scripts.js`), `public/revo/js/scripts.bundle.js`);



// Build custom 3rd party plugins
(glob.sync(`resources/assets/core/plugins/custom/**/*.js`) || []).forEach(file => {
    mix.js(file, `public/revo/${file.replace(`resources/assets/core/`, '').replace('.js', '.bundle.js')}`);
});
(glob.sync(`resources/assets/core/plugins/custom/**/*.scss`) || []).forEach(file => {
    mix.sass(file, `public/revo/${file.replace(`resources/assets/core/`, '').replace('.scss', '.bundle.css')}`);
});

// Build Metronic css pages (single page use)
(glob.sync(`resources/assets/revo/sass/pages/**/!(_)*.scss`) || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace(`resources/assets/revo/sass`, `public/revo/css`).replace(/\.scss$/, '.css'));
});

var extendedFiles = [];
// Extend custom js files for laravel
(glob.sync('resources/assets/extended/js/**/*.js') || []).forEach(file => {
    var output = `public/revo/${file.replace('resources/assets/extended/', '')}`;
    mix.js(file, output);
    extendedFiles.push(output);
});

// Metronic js pages (single page use)
(glob.sync('resources/assets/core/js/custom/**/*.js') || []).forEach(file => {
    var output = `public/revo/${file.replace('resources/assets/core/', '')}`;
    if (extendedFiles.indexOf(output) === -1) {
        mix.js(file, output);
    }
});
(glob.sync(`resources/assets/revo/js/custom/**/*.js`) || []).forEach(file => {
    var output = `public/revo/${file.replace(`resources/assets/revo/`, '')}`;
    if (extendedFiles.indexOf(output) === -1) {
        mix.js(file, output);
    }
});

// Metronic media
mix.copyDirectory('resources/assets/core/media', `public/revo/media`);
mix.copyDirectory(`resources/assets/revo/media`, `public/revo/media`);

// Metronic theme
(glob.sync(`resources/assets/revo/sass/themes/**/!(_)*.scss`) || []).forEach(file => {
    file = file.replace(/[\\\/]+/g, '/');
    mix.sass(file, file.replace(`resources/assets/revo/sass`, `public/revo/css`).replace(/\.scss$/, '.css'));
});

let plugins = [
    new ReplaceInFileWebpackPlugin([
        {
            // rewrite font paths
            dir: path.resolve(`public/revo/plugins/global`),
            test: /\.css$/,
            rules: [
                {
                    // fontawesome
                    search: /url\((\.\.\/)?webfonts\/(fa-.*?)"?\)/g,
                    replace: 'url(./fonts/@fortawesome/$2)',
                },
                {
                    // flaticon
                    search: /url\(("?\.\/)?font\/(Flaticon\..*?)"?\)/g,
                    replace: 'url(./fonts/flaticon/$2)',
                },
                {
                    // flaticon2
                    search: /url\(("?\.\/)?font\/(Flaticon2\..*?)"?\)/g,
                    replace: 'url(./fonts/flaticon2/$2)',
                },
                {
                    // keenthemes fonts
                    search: /url\(("?\.\/)?(Ki\..*?)"?\)/g,
                    replace: 'url(./fonts/keenthemes-icons/$2)',
                },
                {
                    // lineawesome fonts
                    search: /url\(("?\.\.\/)?fonts\/(la-.*?)"?\)/g,
                    replace: 'url(./fonts/line-awesome/$2)',
                },
                {
                    // socicons
                    search: /url\(("?\.\.\/)?font\/(socicon\..*?)"?\)/g,
                    replace: 'url(./fonts/socicon/$2)',
                },
                {
                    // bootstrap-icons
                    search: /url\(.*?(bootstrap-icons\..*?)"?\)/g,
                    replace: 'url(./fonts/bootstrap-icons/$1)',
                },
            ],
        },
    ]),
];

mix.webpackConfig({
    plugins: plugins,
    ignoreWarnings: [{
        module: /esri-leaflet/,
        message: /version/,
    }],
});

// Webpack.mix does not copy fonts, manually copy
(glob.sync(`resources/assets/revo/plugins/**/*.+(woff|woff2|eot|ttf)`) || []).forEach(file => {
    var folder = file.match(/resources\/metronic\/plugins\/(.*?)\//)[1];
    mix.copy(file, `public/revo/plugins/global/fonts/${folder}/${path.basename(file)}`);
});
(glob.sync('node_modules/+(@fortawesome|socicon|line-awesome|bootstrap-icons)/**/*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
    var folder = file.match(/node_modules\/(.*?)\//)[1];
    mix.copy(file, `public/revo/plugins/global/fonts/${folder}/${path.basename(file)}`);
});

// Raw plugins
(glob.sync(`resources/assets/core/plugins/custom/**/*.js.json`) || []).forEach(file => {
    let filePaths = JSON.parse(fs.readFileSync(file, 'utf-8'));
    const fileName = path.basename(file).replace('.js.json', '');
    mix.scripts(filePaths, `public/revo/plugins/custom/${fileName}/${fileName}.bundle.js`);
});
