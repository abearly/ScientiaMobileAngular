<!DOCTYPE html>
<html lang="en"  ng-app="app">
    <head>
        <meta charset="utf-8" />

        <title>Welcome</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {!! HTML::style('css/equal-height-columns.css') !!}
        <style>
            .notifications .notifications-container {
                z-index: 1400;
            }
        </style>
        @include('layouts.includes')
    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>

    </body>
</html>
