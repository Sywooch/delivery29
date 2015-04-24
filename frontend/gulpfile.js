var gulp = require('gulp'),
    connect = require('gulp-connect'),
    plumber = require('gulp-plumber'),
    notify = require('gulp-notify'),
    stylus = require('gulp-stylus'),
    prefix = require('gulp-autoprefixer'),
    postcss = require('gulp-postcss'),
    jade = require('gulp-jade'),
    concat = require('gulp-concat'),
    buildFolder = '../web',
    srcFolder = './web';
var less = require('gulp-less');
var path = require('path');
var minifyCss = require('gulp-minify-css');

gulp.task('connect', function() {
    return connect.server({
        port: 63342,
        livereload: true,
        root: buildFolder
    });
});

gulp.task('css', function() {
    gulp.src(srcFolder + "/**/[^_]*.less")
        .pipe(plumber({errorHandler: notify.onError("Css error: <%= error.message %>")}))
        .pipe(less({
              paths: [ path.join(__dirname, 'less', 'includes') ]
            }))
        .pipe(concat('style.css'))
        .pipe(prefix('> 1%'))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(gulp.dest(buildFolder+'/css'))
        .pipe(connect.reload())
        .pipe(notify("Css succeed"));
});

gulp.task('html', function() {
    gulp.src(srcFolder + "/[^_]*.jade")
        .pipe(plumber({errorHandler: notify.onError("Html error: <%= error.message %>")}))
        .pipe(jade())
        .pipe(gulp.dest(buildFolder))
        .pipe(connect.reload())
        .pipe(notify({
            message: "Html succeed",
            onLast: true
        }));
});


gulp.task('copy', function() {
    gulp.src(srcFolder + "/files/**/*.*")
        .pipe(gulp.dest(buildFolder))
        .pipe(notify("Sir, each file has been copied"));
});

gulp.task('default', ['css', 'html'], function( ) {
    gulp.watch([srcFolder + "/**/[^_]*.less"], ['css']);
});

gulp.task('build', ['css', 'html', 'copy']);