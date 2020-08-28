"use strict";

// Dependencies
var _require = require('gulp'),
    watch = _require.watch,
    series = _require.series,
    parallel = _require.parallel;

var bs = require('browser-sync').create();

var config = require('../config.js');

var _require2 = require('../helpers/handle-errors.js'),
    handleError = _require2.handleError; // Task


function watchfiles() {
  bs.init(config.browsersync.src, config.browsersync.opts);
  watch(config.styles.src, series('scsslint', 'styles', 'gutenbergstyles')).on('error', handleError('styles'));
  watch(config.php.src, series('phpcs')).on('change', bs.reload);
  watch(config.js.src, series('js')).on('change', bs.reload);
}

;
exports.watch = watchfiles;