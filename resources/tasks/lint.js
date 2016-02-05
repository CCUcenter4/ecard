var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var plugins = gulpLoadPlugins();

gulp.task('lint', function() {
  return gulp.src([
    './resources/assets/**/*.js',
    './resources/tasks/**/*.js',
    './gulpfile.js'])
  .pipe(plugins.jscs())
  .pipe(plugins.jscs.reporter('jscs-stylish'));
});
