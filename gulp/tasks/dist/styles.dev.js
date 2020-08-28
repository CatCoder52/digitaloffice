"use strict";

// Dependencies
var _require = require('gulp'),
    dest = _require.dest,
    src = _require.src;

var sass = require('gulp-sass');

var postcss = require('gulp-postcss');

var rename = require('gulp-rename');

var autoprefixer = require('autoprefixer');

var cleancss = require('gulp-clean-css');

var config = require('../config.js');

var _require2 = require('../helpers/handle-errors.js'),
    handleError = _require2.handleError;

var bs = require('browser-sync');

var notify = require('gulp-notify');

function styles(done) {
  var plugins = [autoprefixer({
    grid: true
  })];
  return src(config.styles.main).pipe(sass(config.styles.opts.development)).on('error', handleError('styles')) // Save expanded version for development
  .pipe(dest(config.styles.dest)) // Production settings
  .pipe(sass(config.styles.opts.production)).pipe(postcss(plugins)).on('error', handleError('styles')).pipe(cleancss(config.cleancss.opts, function (details) {
    console.log('[clean-css] Original: ' + details.stats.originalSize / 1000 + ' kB');
    console.log('[clean-css] Minified: ' + details.stats.minifiedSize / 1000 + ' kB');
    console.log('[clean-css] Compression time: ' + details.stats.timeSpent + ' ms');
    console.log('[clean-css] Compression rate: ' + details.stats.efficiency * 100 + ' %');
  })) // Save minified version for production
  .pipe(rename(config.rename.min)).pipe(dest(config.styles.dest)) // Inject changes to browser
  .pipe(bs.stream());
  done();
}

function gutenbergstyles(done) {
  var plugins = [autoprefixer({
    grid: true
  })];
  return src(config.styles.gutenberg).pipe(sass(config.styles.opts.development)).on('error', handleError('styles')) // Production settings
  .pipe(sass(config.styles.opts.production)).pipe(postcss(plugins)).on('error', handleError('styles')).pipe(cleancss(config.cleancss.opts, function (details) {
    console.log('[clean-css] Original: ' + details.stats.originalSize / 1000 + ' kB');
    console.log('[clean-css] Minified: ' + details.stats.minifiedSize / 1000 + ' kB');
    console.log('[clean-css] Compression time: ' + details.stats.timeSpent + ' ms');
    console.log('[clean-css] Compression rate: ' + details.stats.efficiency * 100 + ' %');
  })) // Save minified version for production
  .pipe(rename(config.rename.min)).pipe(dest(config.styles.dest)) // Inject changes to browser
  .pipe(bs.stream());
  done();
}

exports.styles = styles;
exports.gutenbergstyles = gutenbergstyles;