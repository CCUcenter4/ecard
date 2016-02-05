var gulp = require('gulp');
var gulpLoadPlugins = require('gulp-load-plugins');
var plugins = gulpLoadPlugins();

var webpack = require('webpack');
var webpackConfig = require('../../webpack.config.js');

var bundler = webpack(webpackConfig, function(err, stats) {});

gulp.task('webpack', function() {
  return ;
});
