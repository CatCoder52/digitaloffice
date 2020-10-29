module.exports = {
  ignorePatterns: ['content/themes/dude/js/dist/*.js', 'content/themes/dude/js/src/*.js', 'content/themes/dude/js/src/**/*.js', 'content/themes/dude/node_modules/**/*.js', 'temp.js', 'content/themes/dude/js/src/front-end.js', '**/gulp/**/*.js', '**/gulp/*.js', 'gulpfile.js'],
  parser: 'babel-eslint',
  extends: 'eslint-config-airbnb/base',
  rules: {
    indent: ['error', 2],
  },
  env: {
    browser: true,
    jquery: true,
  },
};
