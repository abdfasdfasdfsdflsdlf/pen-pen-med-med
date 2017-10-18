var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});
// var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.less('admin-lte/AdminLTE.less', 'public/penmedia/css');
    mix.less('bootstrap/bootstrap.less', 'public/penmedia/css');
    mix.less('../../../packages/penmedia/common/resources/assets/less/style.less', 'public/penmedia/css') 
});

/*
var minify = require('gulp-minify');
gulp.task('compress', function() {
  gulp.src('lib/*.js')
    .pipe(minify({
        ext:{
            src:'-debug.js',
            min:'.js'
        },
        exclude: ['tasks'],
        ignoreFiles: ['.combo.js', '-min.js']
    }))
    .pipe(gulp.dest('dist'))
});
*/