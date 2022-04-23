'use strict';

var gulp = require('gulp');
var util = require('util');
var path = require('path');
var immutable = require('immutable');
var gulpWebpack = require('gulp-webpack');
var webpack = require('webpack');
var sourcemaps = require('gulp-sourcemaps');
var exec = require('child_process').execSync;
var sass = require('gulp-sass');
var cleancss = require('gulp-clean-css');
var csscomb = require('gulp-csscomb');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var pwd = exec('pwd').toString();

// configure the paths
var watch_dir = './scss/**/*.scss';
var src_dir = './scss/*.scss';
var dest_dir = './assets';

var paths = {
    source: src_dir
};

var plugins = {};
var base = immutable.fromJS(require('./webpack.conf.js'));
var options = {
    prod: base.mergeDeep({
        devtool: 'source-map',
        optimization: {minimize: true},
        plugins: [
            new webpack.DefinePlugin({
                'process.env': { NODE_ENV: '"production"' }
            }),
            new webpack.ProvidePlugin(plugins)
        ],
        output: {
            filename: 'form.min.js'
        }
    })
};

// var compileJS = function(watch) {
//     var prodOpts = options.prod.set('watch', watch);
//
//     return gulp.src('app/main.js')
//         .pipe(gulpWebpack(prodOpts.toJS()))
//         .pipe(gulp.dest('assets/'));
// };

var compileCSS = function() {
    return gulp.src(paths.source)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compact', precision: 10})
            .on('error', sass.logError)
        )
        .pipe(sourcemaps.write())
        .pipe(autoprefixer())
        .pipe(gulp.dest(dest_dir))
        .pipe(csscomb())
        .pipe(cleancss())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(dest_dir));
};

// gulp.task('js', function() {
//     compileJS(false);
// });

gulp.task('css', function() {
    compileCSS();
});

gulp.task('watch', function() {
    gulp.watch(watch_dir, ['css']);
    // compileJS(true);
});

gulp.task('all', ['css']);
gulp.task('default', ['all']);
