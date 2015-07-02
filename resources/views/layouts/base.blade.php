<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nisam!</title>
        <meta name="author" content="Goran Banina" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/component2.css" />
        <link rel="stylesheet" type="text/css" href="css/elements.css" />

        <script src="js/modernizr-2.6.2.min.js"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="jquery.label_better.js"></script>
        <script type="text/javascript" src="js/jquery.countdown.min.js"></script>

        <script>
          $(document).ready( function() {
            $(".label_better").label_better({
              easing: "bounce"
            });
          });
        </script>

    </head>
    <body>
      <div class="container">
            <!-- Top Navigation -->
            <div class="codrops-top clearfix">
                <a class=" codrops-icon codrops-icon-drop" href="https://github.com/gbanina/whose-turn-is-it.git"><span>Nisam GitHub</span></a>
                @if(Auth::guest())
                    <span class="right"><a class="codrops-icon codrops-icon-prev" href="http://influendo.com/"><span>Influendo Interweb</span></a></span>
                @else
                    <span class="right"><a class="codrops-icon codrops-icon-prev" href="{{ route('logout') }}"><span>Logout {{ Auth::user()->name }}</span></a></span>
                @endif
            </div>

         @yield('body')

      </div>
         <script src="js/polyfills.js"></script>
    </body>
</html>
