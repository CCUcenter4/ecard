var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var plugins = gulpLoadPlugins();

gulp.task('sass', function() {
  return gulp.src('./resources/assets/sass/**/*.scss')
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass({ importer: require('./helper/sass-importer') }))
    .pipe(plugins.sourcemaps.write())
    .pipe(gulp.dest('./public/assets/css'));
});
