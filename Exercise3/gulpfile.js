var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

 elixir(function(mix) {
    mix.copy('node_modules/angular', 'public/components/angular');
    mix.copy('node_modules/jquery', 'public/components/jquery');
    mix.copy('node_modules/bootstrap', 'public/components/bootstrap');
    mix.copy('node_modules/@uirouter/angularjs', 'public/components/angular-ui-router');
    mix.copy('node_modules/underscore', 'public/components/underscore');
    mix.copy('node_modules/angular-ui-bootstrap', 'public/components/angular-bootstrap');
    mix.scripts([
      '../../../public/js/app/main.js',
      '../../../public/js/app/app.state.js',
      '../../../public/js/app/*.controller.js',
      '../../../public/js/app/*.service.js',
      '../../../public/js/app/*.directive.js'
  ], 'public/dist/js/main.js');
 });
