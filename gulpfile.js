var gulp = require('gulp'),
  browserSync = require('browser-sync'),
  sass = require('gulp-sass'),
  cleancss = require('gulp-clean-css'),
  autoprefixer = require('gulp-autoprefixer'),
  sourcemaps = require('gulp-sourcemaps'),
  sassGlob = require('gulp-sass-glob'),
  uglify = require('gulp-uglify-es').default;

// Local server
gulp.task('browser-sync', function() {
  browserSync({
    proxy: 'http://lustshop.local/',
    notify: true,
  });
});

// Sass
gulp.task('sass', function() {
  return gulp
    .src('sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sassGlob())
    .pipe(sass({ outputStyle: 'compressed' }))
    .pipe(
      autoprefixer({
        grid: true,
        overrideBrowserslist: ['last 2 versions'],
      }),
    )
    .pipe(cleancss({ level: { 1: { specialComments: 0 } } }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./dist/css'))
    .pipe(browserSync.stream());
});

gulp.task('js', function() {
  return gulp
    .src('js/**/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js'))
    .pipe(browserSync.stream());
});

// Task Watch
gulp.task('watch', function() {
  gulp.watch('sass/**/*.scss', gulp.parallel('sass'));
  gulp.watch('js/**/*.js', gulp.parallel('js'));
});

gulp.task('default', gulp.parallel('watch', 'sass', 'js', 'browser-sync'));
