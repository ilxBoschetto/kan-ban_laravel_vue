<html>
    <head>
        @vite(['resources/css/app.css','resources/js/app.js'])
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <div id="app">
            <nav-menu></nav-menu>
            <div class="content-wrapper">
                <router-view></router-view>
            </div>
        </div>
    </body>
</html>