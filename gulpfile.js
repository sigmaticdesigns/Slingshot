var elixir = require('laravel-elixir');

var gulp = require("gulp");
var less = require("gulp-less");
var plumber = require("gulp-plumber");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var minify = require("gulp-minify-css");
var rename = require("gulp-rename");
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");
var csscomb = require("gulp-csscomb");


gulp.task("compile", function() {
    return gulp.src("resources/assets/less/style.less")
        .pipe(plumber())
        .pipe(less())
        .pipe(postcss([
            autoprefixer({browsers: "last 2 versions"})
        ]))
        .pipe(csscomb())
        .pipe(rename("style.css"))
        //.pipe(gulp.dest("public/css"))
        //.pipe(minify())
        //.pipe(rename("style.min.css"))
        .pipe(gulp.dest("public/css"));
});
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
    mix.task('compile');
    //mix.less('style.less')
});

elixir(function(mix) {
    mix.scripts(['toastr.js', 'vendor/slick.js', 'vendor/jquery.pickmeup.js', 'app.js', 'script.js'], 'public/js/all.js');
});
