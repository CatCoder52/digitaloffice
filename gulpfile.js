/*

REQUIRED STUFF
==============
*/

var gulp = require("gulp");
var sass = require("gulp-sass");
var sourcemaps = require("gulp-sourcemaps");
var browsersync = require("browser-sync").create();
var notify = require("gulp-notify");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var cleancss = require("gulp-clean-css");
var uglify = require("gulp-uglify-es").default;
var concat = require("gulp-concat");
var util = require("gulp-util");
var header = require("gulp-header");
var pixrem = require("gulp-pixrem");
var exec = require("child_process").exec;
var rename = require("gulp-rename");
var stylefmt = require("gulp-stylefmt");
var debug = require("gulp-debug");
var scsslint = require("gulp-scss-lint");
var cache = require("gulp-cached");
var phpcs = require("gulp-phpcs");
var validatehtml = require("gulp-w3c-html-validation");
var a11y = require("gulp-accessibility");

// Better CSS error reporting
const printGulpPluginErrorBeautifully = require("@wulechuan/printer-for-errors-of-gulp-plugins");
const exampleSourceFileBasePath = ".";
const errorOfGlupPluginsPrintingConfigurations = {
  // This simply helps the logger print shorter paths
  // so that file paths looks better in narrow console windows.
  basePathToShortenPrintedFilePaths: exampleSourceFileBasePath,

  colorTheme: {
    heading: {
      lineColor: "magenta",
    },
  },
};

/*

FILE PATHS
==========
*/

var themeDir = "content/themes/dude";
var sassSrc = themeDir + "/sass/**/*.{sass,scss}";
var sassFile = themeDir + "/sass/base/global.scss";
var phpSrc = themeDir + "/**/*.php";
var cssDest = themeDir + "/css";
var customJs = themeDir + "/js/src/scripts.js";
var jsSrc = themeDir + "/js/src/**/*.js";
var jsDest = themeDir + "/js";
var leffatSass = themeDir + "/sass/base/leffat.scss";
var gutenbergFile = themeDir + "/sass/base/gutenberg.scss";

/*

ERROR HANDLING
==============
*/

var handleError = function (task) {
  return function (err) {
    notify.onError({
      message: task + " failed, check the logs...",
    })(err);

    // util.log(util.colors.bgRed(task + ' error:'), util.colors.red(err));
    printGulpPluginErrorBeautifully(
      err,
      errorOfGlupPluginsPrintingConfigurations
    );
  };
};

/*

browsersync
===========

Notes:
   - Add only file types you are working on - if watching the whole themeDir,
     task trigger will be out of sync because of the sourcemap-files etc.
   - Adding only part of the files will also make the task faster

*/

gulp.task("browsersync", function () {
  var files = [themeDir + "/**/*.php", jsSrc];

  browsersync.init(files, {
    proxy: "dude.test",
    browser: "Google Chrome",
    open: false,
    notify: true,
    reloadDelay: 1000,
  });
});

/*

STYLES
======
*/

var stylefmtfile = function (file) {
  console.log(
    util.colors.white("[") +
      util.colors.yellow("Stylefmt") +
      util.colors.white("] ") +
      "Automatically correcting file based on .stylelintrc..."
  );
  var currentdirectory = process.cwd() + "/";
  var modifiedfile = file.path.replace(currentdirectory, "");
  var filename = modifiedfile.replace(/^.*[\\\/]/, "");
  var correctdir = modifiedfile.replace(filename, "");

  gulp
    .src(modifiedfile)

    // Cache this action to prevent watch loop
    .pipe(cache("stylefmtrunning"))

    // Run current file through stylefmt
    .pipe(stylefmt({ configFile: themeDir + "/.stylelintrc" }))

    // Overwrite
    .pipe(gulp.dest(correctdir));
};

gulp.task("scss-lint", function () {
  gulp
    .src([
      sassSrc,
      "!" + themeDir + "/sass/navigation/_burger.scss",
      "!" + themeDir + "/sass/base/_normalize.scss",
    ])

    // Cache this action to prevent watch loop
    .pipe(cache("scsslintrunning"))

    // Print linter report
    .pipe(scsslint());
});

gulp.task("styles", function () {
  // Adds browser fallback (eg. -webkit, -moz, etc.)
  // When a browser dies, Autoprefixer will automatically stop writing prefixes for that browser
  // Source: https://css-tricks.com/css-grid-in-ie-css-grid-and-the-new-autoprefixer/
  // Note: After new version browser settings are in package.json
  var plugins = [autoprefixer({ grid: true })];

  // Save compressed version
  gulp
    .src(sassFile)

    .pipe(
      sass({
        compass: false,
        bundleExec: true,
        sourcemap: false,
        style: "compressed",
        debugInfo: true,
        lineNumbers: true,
        errLogToConsole: true,
        includePaths: [themeDir + "/node_modules/"],
      })
    )

    .on("error", handleError("styles"))
    .pipe(postcss(plugins))
    .pipe(pixrem())
    .pipe(
      cleancss(
        {
          compatibility: "ie11",
          level: {
            1: {
              tidyAtRules: true,
              cleanupCharsets: true,
              specialComments: 0,
            },
          },
        },
        function (details) {
          //console.log('[clean-css] Original size: ' + details.stats.originalSize + ' bytes');
          //console.log('[clean-css] Minified size: ' + details.stats.minifiedSize + ' bytes');
          console.log(
            "[clean-css] Time spent on minification: " +
              details.stats.timeSpent +
              " ms"
          );
          console.log(
            "[clean-css] Compression efficiency: " +
              details.stats.efficiency * 100 +
              " %"
          );
        }
      )
    )
    .pipe(
      rename({
        suffix: ".min",
      })
    )
    .pipe(gulp.dest(cssDest))
    .pipe(browsersync.stream());

  // Save expanded version
  gulp
    .src(sassFile)

    .pipe(
      sass({
        compass: false,
        bundleExec: true,
        sourcemap: false,
        style: "expanded",
        debugInfo: true,
        lineNumbers: true,
        errLogToConsole: true,
        includePaths: [themeDir + "/node_modules/"],
      })
    )

    .on("error", handleError("styles"))
    .pipe(postcss(plugins))
    .pipe(pixrem())

    // Process the expanded output with Stylefmt
    .pipe(stylefmt({ configFile: themeDir + "/.stylelintrc" }))
    .pipe(gulp.dest(cssDest))
    .pipe(browsersync.stream());

  // Save gutenberg styles
  gulp
    .src(gutenbergFile)

    .pipe(
      sass({
        compass: false,
        bundleExec: true,
        sourcemap: false,
        style: "compressed",
        debugInfo: true,
        lineNumbers: true,
        errLogToConsole: true,
        includePaths: [
          themeDir + "/node_modules/",
          "node_modules/",
          // require('node-bourbon').includePaths
        ],
      })
    )

    .on("error", handleError("styles"))
    .pipe(postcss(plugins))
    .pipe(pixrem())
    .pipe(
      cleancss(
        {
          compatibility: "ie11",
          level: {
            1: {
              tidyAtRules: true,
              cleanupCharsets: true,
              specialComments: 0,
            },
          },
        },
        function (details) {
          //console.log('[clean-css] Original size: ' + details.stats.originalSize + ' bytes');
          //console.log('[clean-css] Minified size: ' + details.stats.minifiedSize + ' bytes');
          console.log(
            "[clean-css] Time spent on minification: " +
              details.stats.timeSpent +
              " ms"
          );
          console.log(
            "[clean-css] Compression efficiency: " +
              details.stats.efficiency * 100 +
              " %"
          );
        }
      )
    )
    .pipe(
      rename({
        suffix: ".min",
      })
    )
    .pipe(gulp.dest(cssDest))
    .pipe(browsersync.stream());
});

// Movies page
gulp.task("leffatsass", function () {
  var plugins = [autoprefixer({ grid: true })];

  gulp
    .src(leffatSass)

    .pipe(
      sass({
        compass: false,
        bundleExec: true,
        sourcemap: false,
        style: "compressed",
        debugInfo: true,
        lineNumbers: true,
        errLogToConsole: true,
        includePaths: [
          themeDir + "/node_modules/",
          "node_modules/",
          "bower_components/",
          // require('node-bourbon').includePaths
        ],
      })
    )

    .on("error", handleError("styles"))
    .pipe(
      cleancss(
        {
          compatibility: "ie11",
          level: {
            1: {
              tidyAtRules: true,
              cleanupCharsets: true,
              specialComments: 0,
            },
          },
        },
        function (details) {
          //console.log('[clean-css] Original size: ' + details.stats.originalSize + ' bytes');
          //console.log('[clean-css] Minified size: ' + details.stats.minifiedSize + ' bytes');
          console.log(
            "[clean-css] Time spent on minification: " +
              details.stats.timeSpent +
              " ms"
          );
          console.log(
            "[clean-css] Compression efficiency: " +
              details.stats.efficiency * 100 +
              " %"
          );
        }
      )
    )
    .pipe(pixrem())
    .pipe(postcss(plugins))
    .pipe(gulp.dest(cssDest))
    .pipe(browserSync.stream());
});

// Run only manually: gulp uncss, because takes some time
gulp.task("uncss", function () {
  gulp
    .src(cssDest + "/global.css")
    .pipe(
      uncss({
        html:
          // Activate gulp-sitemap-generator and go to http://dude.test?show_sitemap, and paste it here:
          ["http://dude.test/"],
      })
    )
    .pipe(gulp.dest(cssDest));
});

/*

PHPCS
======
*/

gulp.task("phpcs", function () {
  gulp
    .src([phpSrc, "!" + themeDir + "/node_modules/**/*"])

    // Validate files using PHP Code Sniffer
    .pipe(
      phpcs({
        bin: "/usr/local/bin/phpcs",
        standard: themeDir + "/phpcs.xml",
        warningSeverity: 0,
      })
    )

    // Log all problems that was found
    .pipe(phpcs.reporter("log"));
});

/*

VALIDATE HTML
=============
*/

// Validator for: https://validator.w3.org/
gulp.task("validatehtml", function () {
  return gulp
    .src([
      phpSrc,
      "!" + themeDir + "/functions.php",
      "!" + themeDir + "/node_modules/**/*",
      "!" + themeDir + "/inc/**/*",
    ])
    .pipe(
      validatehtml({
        generateReport: false,
        useTimeStamp: false,
        errorTemplate: null,
        reportpath: false,
        doctype: "HTML5",

        // Ignore WordPress/PHP-related/file structure related error messages
        relaxerror: [
          /XML processing/g,
          /role is unnecessary for element/g,
          /Text not allowed in element “ol” in this context/g,
          /Text not allowed in element “ul” in this context/g,
          /Stray end tag/g,
          /Stray start tag/g,
          /Stray doctype/g,
          /Unsupported character encoding name/g,
          /CSS:/g,
          /Try escaping it as/g,
          /Attribute “<\?php”/g,
          /Attribute “post_/g,
          /An ID must not contain whitespace/g,
          /Attribute “\?” not allowed on element/g,
          /Attribute “{” not allowed on element/g,
          /“echo”/g,
          /“%1\$s”/g,
          /Attribute “'id” not allowed on element/g,
          /Attribute “';” not allowed on element/g,
          /Attribute “}” not allowed on element/g,
          /Attribute “\$/g,
          /Bad value “%s”/g,
          /Bad value “<\?php/g,
          /Bad value “post/g,
          /Attribute “if”/g,
          /Attribute “\(”/g,
          /Attribute “\)”/g,
          /Attribute “:”/g,
          /Saw “<” when expecting an attribute name/g,
          /Article lacks heading/g,
          /Element “head” is missing a required instance of child element/g,
          /Start tag seen without seeing a doctype first/g,
          /Illegal character in path segment/g,
          /is not serializable as XML/g,
          /No space between attributes./g,
          /Saw “'” when/g,
          /End tag seen without seeing a doctype first/g,
          /Non-space characters found without seeing a doctype first/g,
          /End of file seen without seeing a doctype first/g,
          /Consider adding a “lang” attribute to the “html”/g,
          /Matching quote missing/g,
          /"End tag for  “body” seen/g,
          /The character encoding was not declared/g,
          /Empty heading./g,
          /Cannot recover after last error/g,
          /Bad value “mailto: <\?php/g,
          /Bad value “tel: <\?/g,
          /Bad value “mailto:<\?php/g,
          /Bad value “tel:<\?/g,
          /<\?php/g,
          /This document appears to be written/g,
          ,
          /“<” is not allowed/g,
          /Attribute “'/g,
          /Attribute “false/g,
          /Attribute “&&”/g,
          /Attribute “isset/g,
          /Duplicate attribute “\$/g,
          /The document is not mappable to XML/g,
        ],
      })
    );
});

/*

ACCESSIBILITY
=============
*/

gulp.task("a11y", function () {
  return gulp
    .src([phpSrc, "!functions.php", "!node_modules/**/*", "!inc/**/*"])
    .pipe(
      a11y({
        accessibilityLevel: "WCAG2A",
        verbose: true,
        force: true,
        reportLevels: {
          notice: false,
          warning: false,
          error: true,
        },

        // Ignore WordPress/PHP-related/file structure related error messages
        ignore: [
          // The html element should have a lang or xml:lang attribute which describes the language of the document.
          "WCAG2A.Principle3.Guideline3_1.3_1_1.H57.2",

          // A title should be provided for the document, using a non-empty title element in the head section.
          "WCAG2A.Principle2.Guideline2_4.2_4_2.H25.1.NoTitleEl",

          // Anchor element found with a valid href attribute, but no link content has been supplied.
          "WCAG2A.Principle4.Guideline4_1.4_1_2.H91.A.NoContent",

          // Heading tag found with no content. Text that is not intended as a heading should not be marked up with heading tags.
          "WCAG2A.Principle1.Guideline1_3.1_3_1.H42.2",

          // This link points to a named anchor "[link target]" within the document, but no anchor exists with that name.
          "WCAG2A.Principle2.Guideline2_4.2_4_1.G1,G123,G124.NoSuchID",
        ],
      })
    )
    .on("error", console.log);
});

/*

SCRIPTS
=======
*/

var currentDate = util.date(new Date(), "dd-mm-yyyy HH:ss");
var pkg = require("./package.json");
var banner = "/*! <%= pkg.name %> <%= currentDate %> - <%= pkg.author %> */\n";

gulp.task("js", function () {
  gulp
    .src([
      themeDir + "/js/src/skip-link-focus-fix.js",
      themeDir + "/node_modules/moveto/dist/moveTo.js",
      themeDir + "/node_modules/timeme.js/timeme.js",
      themeDir + "/js/src/navigation.js",
      themeDir + "/js/src/svg-morpheus.js",
      themeDir + "/js/src/lazyload.js",
      themeDir + "/js/src/slick.custom.js",
      themeDir + "/node_modules/swup/dist/swup.js",
      themeDir + "/node_modules/what-input/dist/what-input.js",
      themeDir +
        "/node_modules/@swup/body-class-plugin/dist/SwupBodyClassPlugin.js",
      themeDir + "/node_modules/@swup/scripts-plugin/dist/SwupScriptsPlugin.js",
      themeDir + "/js/src/scripts.js",
    ])
    .pipe(sourcemaps.init())
    .pipe(concat("all.js"))
    .pipe(
      uglify({
        compress: true,
        mangle: true,
      }).on("error", function (err) {
        util.log(util.colors.red("[Error]"), err.toString());
        this.emit("end");
      })
    )
    .pipe(header(banner, { pkg: pkg, currentDate: currentDate }))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(jsDest));
});

gulp.task("js-store", function () {
  gulp
    .src([themeDir + "/js/src/store.js"])
    .pipe(concat("store.js"))
    .pipe(
      uglify({
        compress: true,
        mangle: false,
      }).on("error", function (err) {
        util.log(util.colors.red("[Error]"), err.toString());
        this.emit("end");
      })
    )
    .pipe(header(banner, { pkg: pkg, currentDate: currentDate }))
    .pipe(gulp.dest(jsDest));
});

/*

WATCH
=====

*/

// Run the JS task followed by a reload
gulp.task("js-watch", ["js"], browsersync.reload);
gulp.task("watch", ["browsersync"], function () {
  gulp.watch(sassSrc, ["styles", "scss-lint"]); // If you want gulp to handle auto styling, add .on( 'change', stylefmtfile ), but we prefer Sublime Text pcakage Stylefmt to hand this for you
  gulp.watch(phpSrc, ["phpcs"]);
  gulp.watch(jsSrc, ["js-watch"]);

  // Movies page
  gulp.watch(leffatSass, ["leffatsass"]);
});

/*

DEFAULT
=====

*/

gulp.task("default", ["watch"]);
