<html>
    <head>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <div id="app">
            <div class="content-wrapper">
                <router-view></router-view>
            </div>
        </div>
    </body>
</html>