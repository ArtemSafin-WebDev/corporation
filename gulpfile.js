'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const plumber = require('gulp-plumber');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const rename = require('gulp-rename');
const cssMinify = require('gulp-csso');
const svgSprite = require('gulp-svg-sprite');
const webpack = require('webpack');
const webpackconfig = require('./webpack.config.js');
const webpackstream = require('webpack-stream');

gulp.task('sprite', function() {
    return gulp
        .src('src/icons/*.svg')
        .pipe(
            svgSprite({
                mode: {
                    inline: true,
                    symbol: {
                        sprite: 'sprite.svg'
                    }
                }
            })
        )
        .pipe(gulp.dest('./img'));
        
});

gulp.task('styles', function() {
    return gulp
        .src('src/scss/styles.scss')
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest('./css'))
        .pipe(cssMinify())
        .pipe(rename('styles.min.css'))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
});

gulp.task('scripts', function() {
    return gulp
        .src('./src/js/**/*')
        .pipe(plumber())
        .pipe(webpackstream(webpackconfig, webpack))
        .pipe(gulp.dest('./js'))
        .pipe(browserSync.stream());
});

gulp.task('scripts-production', function() {
    return gulp
        .src('./src/js/**/*')
        .pipe(plumber())
        .pipe(webpackstream({ ...webpackconfig, mode: 'production', devtool: 'source-map' }, webpack))
        .pipe(gulp.dest('./js'))
        .pipe(browserSync.stream());
});

gulp.task('serve', function() {
    browserSync.init({
        proxy: 'http://corporation.me/',
        ghostMode: false
    });
    gulp.watch('./src/icons/*svg', gulp.series('sprite'));
    gulp.watch('./src/scss/**/*.scss', gulp.series('styles'));
    gulp.watch('./src/js/**/*.js', gulp.series('scripts'));
    gulp.watch('./**/*.php', function(cb) {
        browserSync.reload();
        cb();
    });
});

gulp.task('build', gulp.series('sprite', gulp.parallel('styles', 'scripts')));

gulp.task('build-production', gulp.series('sprite', gulp.parallel('styles', 'scripts-production')));

gulp.task('default', gulp.series('build', 'serve'));
