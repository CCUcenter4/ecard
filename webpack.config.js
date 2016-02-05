var path = require('path');
var webpack = require('webpack');
var spiltByPathPlugin = require('webpack-split-by-path');

module.exports = {
  entry: {
    'bundle': './resources/assets/javascript/main.js'
  },
  output: {
    filename: '[name].js',
    path: 'public'
  },
  external: {
    jquery: 'jquery',
    bootstrap: 'bootstrap-sass'
  }
};
