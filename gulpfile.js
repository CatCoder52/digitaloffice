/*

REQUIRED STUFF
==============
*/

var gulp           = require('gulp');
var sass           = require('gulp-sass');
var sourcemaps     = require('gulp-sourcemaps');
var browsersync    = require('browser-sync').create();
var notify         = require('gulp-notify');
var postcss        = require('gulp-postcss');
var autoprefixer   = require('autoprefixer');
var cleancss       = require('gulp-clean-css');
var uglify         = require('gulp-uglify-es').default;
var concat         = require('gulp-concat');
var util           = require('gulp-util');
var header         = require('gulp-header');
var pixrem         = require('gulp-pixrem');
var exec           = require('child_process').exec;
var rename         = require('gulp-rename');
var stylefmt       = require('gulp-stylefmt');
var debug          = require('gulp-debug');
var scsslint       = require('gulp-scss-lint');
var cache          = require('gulp-cached');
var phpcs          = require('gulp-phpcs');
var validatehtml   = require('gulp-w3c-html-validation');
var a11y           = require('gulp-accessibility');
var uncss          = require('gulp-uncss');

/*

FILE PATHS
==========
*/

var themeDir = 'content/themes/dude';
var sassSrc = themeDir + '/sass/**/*.{sass,scss}';
var sassFile = themeDir + '/sass/base/global.scss';
var phpSrc = themeDir + '/**/*.php';
var cssDest = themeDir + '/css';
var customjs = themeDir + '/js/scripts.js';
var jsSrc = themeDir + '/js/src/**/*.js';
var jsDest = themeDir + '/js';

/*

ERROR HANDLING
==============
*/

var handleError = function(task) {
  return function(err) {

      notify.onError({
        message: task + ' failed, check the logs...'
      })(err);

    util.log(util.colors.bgRed(task + ' error:'), util.colors.red(err));
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

gulp.task('browsersync', function() {

  var files = [
    themeDir + '/**/*.php',
    jsSrc
  ];

  browsersync.init(files, {
    proxy: "dude.test",
    browser: "Google Chrome",
    open: false,
    notify: true,
    reloadDelay: 1000
  });

});

/*

STYLES
======
*/

var stylefmtfile = function( file ) {

    console.log(util.colors.white('[') + util.colors.yellow('Stylefmt') + util.colors.white('] ') + 'Automatically correcting file based on .stylelintrc...');
    var currentdirectory = process.cwd() + '/';
    var modifiedfile = file.path.replace( currentdirectory, '' );
    var filename = modifiedfile.replace(/^.*[\\\/]/, '')
    var correctdir = modifiedfile.replace( filename, '' );

    gulp.src(modifiedfile)

        // Cache this action to prevent watch loop
        .pipe(cache('stylefmtrunning'))

        // Run current file through stylefmt
        .pipe(stylefmt({ configFile: themeDir + '/.stylelintrc' }))

        // Overwrite
        .pipe(gulp.dest(correctdir))
};

gulp.task('scss-lint', function() {
  gulp.src([sassSrc, '!' + themeDir + '/sass/navigation/_burger.scss', '!' + themeDir + '/sass/layout/_columns.scss', '!' + themeDir + '/sass/base/_normalize.scss'])

    // Cache this action to prevent watch loop
    .pipe(cache('scsslintrunning'))

    // Print linter report
    .pipe(scsslint());
});

gulp.task('styles', function() {

    var plugins = [
        autoprefixer({grid: true})
    ];

    // Save compressed version
    gulp.src(sassFile)

    .pipe(sourcemaps.init())
    .pipe(sass({
      compass: false,
      bundleExec: true,
      sourcemap: false,
      style: 'compressed',
      debugInfo: true,
      lineNumbers: true,
      errLogToConsole: true,
      includePaths: [
        themeDir + '/node_modules/',
        'node_modules/',
        // require('node-bourbon').includePaths
      ],
    }))

    .on('error', handleError('styles'))
    .pipe(postcss(plugins))
    .pipe(pixrem())
    .pipe(cleancss({
      compatibility: 'ie11',
      level: {
        1: {
          tidyAtRules: true,
          cleanupCharsets: true,
          specialComments: 0
        }
      }
    }, function(details) {
        //console.log('[clean-css] Original size: ' + details.stats.originalSize + ' bytes');
        //console.log('[clean-css] Minified size: ' + details.stats.minifiedSize + ' bytes');
        console.log('[clean-css] Time spent on minification: ' + details.stats.timeSpent + ' ms');
        console.log('[clean-css] Compression efficiency: ' + details.stats.efficiency * 100 + ' %');
    }))
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(cssDest))
    .pipe(browsersync.stream());

    // Save expanded version
    gulp.src(sassFile)

    .pipe(sass({
      compass: false,
      bundleExec: true,
      sourcemap: false,
      style: 'expanded',
      debugInfo: true,
      lineNumbers: true,
      errLogToConsole: true,
      includePaths: [
        themeDir + '/node_modules/',
        'node_modules/',
        // require('node-bourbon').includePaths
      ],
    }))

    .on('error', handleError('styles'))
    .pipe(postcss(plugins))
    .pipe(pixrem())

    // Process the expanded output with Stylefmt
    gulp.src('css/global.css')
    .pipe(stylefmt({ configFile: themeDir + '/.stylelintrc' }))
    .pipe(gulp.dest(cssDest))

});

// Run only manually: gulp uncss, because takes some time
gulp.task('uncss', function() {

  gulp.src(cssDest + '/global.min.css')
    .pipe(uncss({
      html:
        // Activate gulp-sitemap-generator and go to http://dude.test?show_sitemap, and paste it here:
        // Updated 10.6.2019 21:39:
        ["https:\/\/www.dude.fi\/dude-fi-loi-nahkansa-esittelyssa-uusi-sivusto","https:\/\/www.dude.fi\/vihreaa-hostingia-100-green-web-hosting","https:\/\/www.dude.fi\/toitamme\/ravintola-sohwi","https:\/\/www.dude.fi\/toitamme\/co2esto","https:\/\/www.dude.fi\/toitamme\/pama-hockey","https:\/\/www.dude.fi\/toitamme\/jylkkari","https:\/\/www.dude.fi\/toitamme\/by-emmi","https:\/\/www.dude.fi\/toitamme\/crm-service","https:\/\/www.dude.fi\/toitamme\/saarikoski-incoming","https:\/\/www.dude.fi\/toitamme\/bar-explosive","https:\/\/www.dude.fi\/toitamme\/elonen","https:\/\/www.dude.fi\/toitamme\/paahtimo-papu","https:\/\/www.dude.fi\/toitamme\/oivangin-lomakartano","https:\/\/www.dude.fi\/toitamme\/hotelli-alba","https:\/\/www.dude.fi\/toitamme\/hameen-keskiaikafestivaali","https:\/\/www.dude.fi\/toitamme\/redan-redan","https:\/\/www.dude.fi\/tyopaikat\/visuaalinen-suunnittelija","https:\/\/www.dude.fi\/kiitos-yhteydenotosta","https:\/\/www.dude.fi\/tyopaikat\/wordpress-kehittaja","https:\/\/www.dude.fi\/toitamme\/bitwise","https:\/\/www.dude.fi\/toitamme","https:\/\/www.dude.fi\/tyopaikat","https:\/\/www.dude.fi\/yhteiso-ja-koodi","https:\/\/www.dude.fi\/yhteystiedot","https:\/\/www.dude.fi\/visuaalinen-suunnittelu","https:\/\/www.dude.fi\/dudet\/henri","https:\/\/www.dude.fi\/dudet\/timi","https:\/\/www.dude.fi\/dudet\/kristian","https:\/\/www.dude.fi\/dudet\/juha","https:\/\/www.dude.fi\/dudet\/roni","https:\/\/www.dude.fi\/yritys","https:\/\/www.dude.fi\/toitamme\/bauer-media","https:\/\/www.dude.fi\/toitamme\/black-bruin","https:\/\/www.dude.fi\/toitamme\/nodeon","https:\/\/www.dude.fi\/toitamme\/sievo","https:\/\/www.dude.fi\/blogi","https:\/\/www.dude.fi\/verkkosivut","https:\/\/www.dude.fi\/","https:\/\/www.dude.fi\/tietosuojaseloste","https:\/\/www.dude.fi\/dudella-uusi-osakas-ja-valoisat-tulevaisuudennakymat","https:\/\/www.dude.fi\/tunnustus-tietokantoihin-liittyen","https:\/\/www.dude.fi\/parasta-koodarin-tyossa-matkani-koodiapinasta-wordpress-ammattilaiseksi","https:\/\/www.dude.fi\/paremman-tarjouspyynnon-anatomia","https:\/\/www.dude.fi\/henri-on-duden-uusin-vahvistus-koodipuolella","https:\/\/www.dude.fi\/dude-nosti-tasoa-kerroksella-esittelyssa-uusi-kauppakadun-toimisto","https:\/\/www.dude.fi\/duden-asiakkaat-ovat-supertyytyvaisia","https:\/\/www.dude.fi\/wordcamp-turku","https:\/\/www.dude.fi\/nain-pyydat-tarjouksen-verkkosivuista","https:\/\/www.dude.fi\/duden-talouskatsaus-2018","https:\/\/www.dude.fi\/7-syyta-miksi-sivustoltasi-poistutaan","https:\/\/www.dude.fi\/oletko-sina-etsimamme-dude-tai-dudette","https:\/\/www.dude.fi\/taytyyko-minun-lisata-sivuille-ponnahdusikkuna-jossa-kerrotaan-evasteista","https:\/\/www.dude.fi\/duden-hovivalokuvaaja-on-vuoden-muotokuvaaja-2018","https:\/\/www.dude.fi\/hakukoneoptimointi-ei-ole-ominaisuus-jonka-voit-laittaa-paalle","https:\/\/www.dude.fi\/ala-hanki-mita-tahansa-webhotellia-wordpress-sivuillesi","https:\/\/www.dude.fi\/kooste-duden-wordpress-meetup-kiertueesta-eraan-digitoimiston-tapa-tehda-verkkosivuja","https:\/\/www.dude.fi\/verkkosivujen-suunnittelu-aikataulussa-totta-vai-tarua","https:\/\/www.dude.fi\/haluatko-pullopostia-rantaasi","https:\/\/www.dude.fi\/wordcamp-jyvaskyla-2018-kokosi-wordpress-kehittajat-yhteen","https:\/\/www.dude.fi\/roni-puhumassa-wordcamp-jyvaskylassa-9-2-2018","https:\/\/www.dude.fi\/sisalto-ei-tule-ensin","https:\/\/www.dude.fi\/isojakin-projekteja-pienella-tiimilla-miten-paletti-pysyy-kasassa","https:\/\/www.dude.fi\/duden-tiimi-kasvaa-kahdella","https:\/\/www.dude.fi\/vuosi-2017-numeroina","https:\/\/www.dude.fi\/duden-wordpress-teema-air-esilla-speckyboy-ja-hongkiat-verkkolehdissa","https:\/\/www.dude.fi\/duden-pieni-talouskatsaus","https:\/\/www.dude.fi\/10-tyonaytetta-syksylta-2017","https:\/\/www.dude.fi\/onko-sivustosi-esteeton","https:\/\/www.dude.fi\/verkkosivujen-ostaja-teeta-sivut-kerralla-ja-kunnolla","https:\/\/www.dude.fi\/sivuston-tekemisen-nakymaton-osuus-tietorakenteen-suunnittelu","https:\/\/www.dude.fi\/tehokkuutta-tyoskentelyyn-todoistin-avulla","https:\/\/www.dude.fi\/wordpress-tapahtuma-metsassa-kooste-ja-kuulumiset-wp-metsasta","https:\/\/www.dude.fi\/mita-lapparin-kansi-kertoo-omistajastaan-esittelyssa-duden-makkien-takakannet","https:\/\/www.dude.fi\/talta-nayttaa-duden-kulma-muuttokuulumiset-jyvaskylan-ytimesta","https:\/\/www.dude.fi\/miksi-digitoimiston-verkkosivuilla-ei-kerrota-hintoja","https:\/\/www.dude.fi\/verkkosivut-kaupantekovalineena-ilman-hienoja-digimarkkinoinnin-trendisanoja","https:\/\/www.dude.fi\/google-pagespeed-nopeustestin-tuloksilla-ei-ole-valia","https:\/\/www.dude.fi\/duden-virallinen-operointimanuaali-julkaistu","https:\/\/www.dude.fi\/mita-lisaosia-dude-kayttaa","https:\/\/www.dude.fi\/wordpress-sivut-raatalille-vai-markettiin","https:\/\/www.dude.fi\/dude-kehittyy-ja-toimitusjohtaja-vaihtuu","https:\/\/www.dude.fi\/sisalto-on-verkkosivuston-sydan","https:\/\/www.dude.fi\/onko-wordcamp-europe-kasvanut-liian-isoksi-wceu17-tarpit","https:\/\/www.dude.fi\/wchel17-jarjestamisesta-ja-yhteison-tulevaisuudesta","https:\/\/www.dude.fi\/mika-niissa-verkkosivuissa-oikein-maksaa","https:\/\/www.dude.fi\/miten-tiedat-milloin-wordpress-sivusi-kaatuvat-esittelyssa-adminlabs","https:\/\/www.dude.fi\/wordpress-on-suosituin-ja-vaarinymmarretyin-verkkosivualusta","https:\/\/www.dude.fi\/nain-duden-sivustouudistus-tapahtui-vaihe-vaiheelta","https:\/\/www.dude.fi\/miksi-edes-pohtia-valitseeko-avoimen-vai-suljetun-lahdekoodin-julkaisujarjestelman","https:\/\/www.dude.fi\/harharetki-palvelinmaailmassa","https:\/\/www.dude.fi\/paljonko-nettisivut-maksavat","https:\/\/www.dude.fi\/ensimmainen-suomenkielinen-wordpress-podcast-julkaistu","https:\/\/www.dude.fi\/wordpress-tokkii-tarua-vai-totta","https:\/\/www.dude.fi\/wordpress-sivut-vielako-joku-kysyy-miksi","https:\/\/www.dude.fi\/duden-digitiimi-wordcamp-europessa-kuulumiset-wienin-reissulta","https:\/\/www.dude.fi\/katsaus-kevaaseen-2016-tyonaytteita-kuulumisia","https:\/\/www.dude.fi\/wordcamp-europe-lahestyy","https:\/\/www.dude.fi\/wordcamp-finland-2016-kooste-duden-kuulumiset-retkelta","https:\/\/www.dude.fi\/digitoimisto-dude-ruumiinavaus-2016","https:\/\/www.dude.fi\/wordpress-optimoitu-palvelin","https:\/\/www.dude.fi\/wordpress-jyvaskyla-esteettomyys","https:\/\/www.dude.fi\/neljas-dude-remmiin","https:\/\/www.dude.fi\/alkuvuoden-tyonaytteita","https:\/\/www.dude.fi\/device-lab-responsiivisen-suunnittelun-apuna","https:\/\/www.dude.fi\/paras-chat-palvelu-yrityksille","https:\/\/www.dude.fi\/parhaat-chat-palvelut-verkkosivuille-osa-2","https:\/\/www.dude.fi\/esittelyssa-kaksi-loppuvuoden-isointa-tyonaytetta","https:\/\/www.dude.fi\/20-suomalaista-digialan-vaikuttajaa-joita-kannattaa-seurata-twitterissa","https:\/\/www.dude.fi\/wordpress-meetup-jyvaskyla","https:\/\/www.dude.fi\/se-kolmas-dude","https:\/\/www.dude.fi\/digitoimisto-dude-oy-ja-hohkavaara","https:\/\/www.dude.fi\/ravintola-sohwin-sivut-uudistuivat","https:\/\/www.dude.fi\/vuoden-2015-ensimmaisen-puoliskon-tyonaytteita","https:\/\/www.dude.fi\/wordpress-verkkosivualustana","https:\/\/www.dude.fi\/avoimen-ja-sosiaalisen-koodaamisen-aikakausi","https:\/\/www.dude.fi\/instagram-kuvat-twitteriin-ja-muita-resepteja","https:\/\/www.dude.fi\/5-asiaa-joita-et-tiennyt-twitterista","https:\/\/www.dude.fi\/wordcamp-finland-2015-oli-onnistunut-reissu","https:\/\/www.dude.fi\/yleisimmat-verkkosivujen-myytit","https:\/\/www.dude.fi\/millaiset-ovat-perussivut","https:\/\/www.dude.fi\/parhaat-chat-palvelut-verkkosivuille","https:\/\/www.dude.fi\/kuumimmat-tyokalut-sivuston-kavijoiden-seurantaan","https:\/\/www.dude.fi\/hakukoneoptimointi-se-parempi-seo-pikaopas","https:\/\/www.dude.fi\/tyokalut-tehokkaampaan-tyoskentelyyn-vuodelle-2015","https:\/\/www.dude.fi\/vuosi-paketissa-ja-fiiliksia-tulevasta","https:\/\/www.dude.fi\/responsiiviset-verkkosivut-mika-miksi-miten","https:\/\/www.dude.fi\/blogi-yritykselle-tarkea-markkinointikanava","https:\/\/www.dude.fi\/pikakelaus-duden-kevaaseen","https:\/\/www.dude.fi\/se-parempi-twitter-pikaopas","https:\/\/www.dude.fi\/odotukset-vuodelle-2014","https:\/\/www.dude.fi\/vuosi-2013-paketissa-dude-toivottaa-hyvaa-joulua","https:\/\/www.dude.fi\/vihdoinkin-wordpress-nykyaikaistui-kertaheitolla","https:\/\/www.dude.fi\/diginatiivi-vai-nortti-elaman-digitalisoituminen-kaytannossa","https:\/\/www.dude.fi\/sosiaalinen-media-hapatusta-vai-todellista-hyotya","https:\/\/www.dude.fi\/check-innausten-aikakausi","https:\/\/www.dude.fi\/bloggaus-nakyy-hakukoneessa-tilapaivitysta-paremmin","https:\/\/www.dude.fi\/twitter-selvassa-kasvussa-suomessa","https:\/\/www.dude.fi\/hyvien-verkkosivujen-ainekset","https:\/\/www.dude.fi\/jos-et-jaa-nakeeko-kukaan","https:\/\/www.dude.fi\/lomalaiselle-rentoa-luettavaa","https:\/\/www.dude.fi\/tulisiko-responsiivinen-design-pakottaa-kayttajalle","https:\/\/www.dude.fi\/pari-juttua-ennen-juhannusta","https:\/\/www.dude.fi\/digitoimisto-on-nykyaikainen-mainostoimisto","https:\/\/www.dude.fi\/firma-parahti-pystyyn"]
          }))
          .pipe(gulp.dest(cssDest));
});

/*

PHPCS
=====
*/

gulp.task('phpcs', function() {

  gulp.src(phpSrc)

    // Validate files using PHP Code Sniffer
    .pipe(phpcs({
      bin: '/usr/local/bin/phpcs',
      standard: themeDir + '/phpcs.xml',
      warningSeverity: 0
    }))

    // Log all problems that was found
    .pipe(phpcs.reporter('log'));
});

/*

VALIDATE HTML
=============
*/

// Validator for: https://validator.w3.org/
gulp.task('validatehtml', function() {
  return gulp.src([phpSrc, '!' + themeDir + '/functions.php', '!' + themeDir + '/node_modules/**/*', '!' + themeDir + '/inc/**/*'])
    .pipe(validatehtml({
        generateReport: false,
        useTimeStamp: false,
        errorTemplate: null,
        reportpath: false,
        doctype: 'HTML5',

        // Ignore WordPress/PHP/Vue.js/file structure related error messages
        relaxerror: [/XML processing/g,
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
        /Attribute “!”/g,
        /Duplicate attribute “\)”/g,
        /Attribute “empty/g,
        /An ID must not contain whitespace/g,
        /Attribute “\?” not allowed on element/g,
        /Attribute “{” not allowed on element/g,
        /"Attribute “v-/g,
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
        /The document is not mappable to XML/g,
        /“=” at the start/g,
        /“=” in an unquoted/g,
        /No “p” element in scope/g,
        /Attribute “v-/g,
        /“data-\*” attribute names must be XML 1.0 4th/g,
        /Attribute “'_blank'”/g,
        /Attribute “'”/g,
        /Attribute “if\(/g,
        /Attribute “get_/g,
        /Attribute “'img/g,
        /Attribute “\)/g,
        /Attribute “has_/g,
        /Attribute “content-{\$/g,
        /Attribute “shade-{\$/g,
        /Attribute “color/g,
        /“<” is not allowed/g,
        /Attribute “'/g,
        /Attribute “&&”/g,
        /Attribute “isset/g,
        /Duplicate attribute “\$/g,
        /Duplicate attribute “\(”/g,
        /Bad value “' . /g]
    }))
});

/*

ACCESSIBILITY
=============
*/

gulp.task('a11y', function() {
  return gulp.src([phpSrc, '!' + themeDir + '/functions.php', '!' + themeDir + '/node_modules/**/*', '!' + themeDir + '/inc/**/*'])
    .pipe(a11y({
      accessibilityLevel: 'WCAG2A',
      verbose: true,
      force: true,
      reportLevels: {
        notice: false,
        warning: false,
        error: true
      },

      // Ignore WordPress/PHP-related/file structure related error messages
      ignore: [
        // The html element should have a lang or xml:lang attribute which describes the language of the document.
        'WCAG2A.Principle3.Guideline3_1.3_1_1.H57.2',

        // A title should be provided for the document, using a non-empty title element in the head section.
        'WCAG2A.Principle2.Guideline2_4.2_4_2.H25.1.NoTitleEl',

        // Anchor element found with a valid href attribute, but no link content has been supplied.
        'WCAG2A.Principle4.Guideline4_1.4_1_2.H91.A.NoContent',

        // Heading tag found with no content. Text that is not intended as a heading should not be marked up with heading tags.
        'WCAG2A.Principle1.Guideline1_3.1_3_1.H42.2',

        // This link points to a named anchor "[link target]" within the document, but no anchor exists with that name.
        'WCAG2A.Principle2.Guideline2_4.2_4_1.G1,G123,G124.NoSuchID'
      ]
    }))
    .on('error', console.log)
});

/*

SCRIPTS
=======
*/

var currentDate   = util.date(new Date(), 'dd-mm-yyyy HH:ss');
var pkg       = require('./package.json');
var banner      = '/*! <%= pkg.name %> <%= currentDate %> - <%= pkg.author %> */\n';

gulp.task('js', function() {

      gulp.src(
        [
          themeDir + '/js/src/skip-link-focus-fix.js',
          themeDir + '/node_modules/moveto/dist/moveTo.js',
          themeDir + '/node_modules/what-input/dist/what-input.js',
          themeDir + '/node_modules/timeme.js/timeme.js',
          themeDir + '/js/src/navigation.js',
          themeDir + '/js/src/svg-morpheus.js',
          themeDir + '/js/src/lazyload.js',
          themeDir + '/js/src/kickass.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-helper.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery-fullscreen.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery-indicator.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery-video.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery-vimeo.js',
          themeDir + '/node_modules/blueimp-gallery/js/blueimp-gallery-youtube.js',
          themeDir + '/node_modules/blueimp-gallery/js/jquery.blueimp-gallery.js',
          themeDir + '/js/src/scripts.js'
        ])
        .pipe(sourcemaps.init())
        .pipe(concat('all.js'))
        .pipe(uglify({
          compress: true,
          mangle: true}).on('error', function(err) {
            util.log(util.colors.red('[Error]'), err.toString());
            this.emit('end');
          }))
        .pipe(header(banner, {pkg: pkg, currentDate: currentDate}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(jsDest));
});

gulp.task('js-store', function() {

      gulp.src(
        [
          themeDir + '/js/src/store.js'
        ])
        .pipe(concat('store.js'))
        .pipe(uglify({
          compress: true,
          mangle: false}).on('error', function(err) {
            util.log(util.colors.red('[Error]'), err.toString());
            this.emit('end');
          }))
        .pipe(header(banner, {pkg: pkg, currentDate: currentDate}))
        .pipe(gulp.dest(jsDest));
});

/*

WATCH
=====

*/

// Run the JS task followed by a reload
gulp.task('js-watch', ['js', 'js-store'], browsersync.reload);
gulp.task('watch', ['browsersync'], function() {

  // Lint SCSS on save, auto correct based on stylefmtfile on change
  gulp.watch(sassSrc, ['styles', 'scss-lint']).on( 'change', stylefmtfile );

  // Please run validation tests manually:
  //
  // gulp validatehtml
  // gulp phpcs
  // pa11y-ci --sitemap http://dude.test/sitemap.xml

  // Auto validation (currently disabled)
  // gulp.watch(phpSrc, ['phpcs', 'validatehtml']);
  gulp.watch(phpSrc);

  // Update browser window automatically when JavaScript is saved
  gulp.watch(jsSrc, ['js-watch']);

});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch']);
