'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

gulp.task('default', watch);

function compilaSass() {
    return gulp
        .src('./assets/scss/*.scss')
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError)) // Converte Sass para CSS minificado com gulp-sass
        .pipe(gulp.dest('./assets/css'));
}

function watch() {
    gulp.watch('./assets/scss/**/*.scss', compilaSass);
}