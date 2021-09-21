var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var sassDataURI = require('lib-sass-data-uri');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const merge = require('gulp-merge');
const strip = require('gulp-strip-comments');

gulp.task('parse-template-scss', function() {
    return gulp.src('src/templates/overwrites/scss/template.scss')
        .pipe(sass({
            errLogToConsole: true,
            functions: Object.assign(sassDataURI, {other: function() {}})
        }))
        .pipe(cleanCSS({compatibility: 'ie11'}))
        .pipe(gulp.dest('src/templates/overwrites/css'))
});

gulp.task('parse-critical-scss', function() {
    return gulp.src('src/templates/overwrites/scss/critical.scss')
        .pipe(sass({
            errLogToConsole: true,
            functions: Object.assign(sassDataURI, {other: function() {}})
        }))
        .pipe(cleanCSS({compatibility: 'ie11'}))
        .pipe(gulp.dest('src/templates/overwrites/css'))
});

gulp.task('parse-script', function() {
  merge(
    gulp.src(['./node_modules/tiny-slider/dist/min/tiny-slider.js']),
    gulp.src(['./node_modules/aos/dist/aos.js']),
    gulp.src(['src/templates/overwrites/js/template.js'])
      .pipe(sourcemaps.init())
      .pipe(babel({
        presets: ['@babel/env']
      }))
      .pipe(sourcemaps.write())
  )
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(strip())
    .pipe(concat('template.min.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('src/templates/overwrites/js'));
});

gulp.task('watch', function() {
    gulp.watch('src/templates/overwrites/scss/**/*.scss', ['parse-template-scss']);
    gulp.watch('src/templates/overwrites/scss/**/*.scss', ['parse-critical-scss']);
    gulp.watch('src/templates/overwrites/js/*.js', ['parse-script']);
});

gulp.task('default', function() {
    gulp.run('watch');
});

