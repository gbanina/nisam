<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nisam!</title>
        <meta name="author" content="Goran Banina" />
        <link rel="shortcut icon" href="{{URL::to('/favicon.ico')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/normalize.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/demo.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/component2.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/elements.css')}}" />
        <link rel="stylesheet" href="{{URL::to('css/jquery-ui.css')}}">
		<link rel="stylesheet" href="{{URL::to('css/jquery.piemenu.css')}}">



        <script src="{{URL::to('js/modernizr-2.6.2.min.js')}}"></script>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="{{URL::to('jquery.label_better.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/jquery.countdown.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('js/jquery.piemenu.js')}}"></script>

        <script>
          $(document).ready( function() {
            $(".label_better").label_better({
              easing: "bounce"
            });
          });
        </script>

    </head>
    <body ng-app="nisamApp">
      <div class="container">
            <!-- Top Navigation -->
            <div class="codrops-top clearfix">
                <a class=" codrops-icon codrops-icon-drop" href="{{ route('main') }}"><span>Nisam Home</span></a>
                @if(Auth::guest())
                    <span class="right"><a class="codrops-icon codrops-icon-prev" href="http://influendo.com/"><span>Influendo Interweb</span></a></span>
                @else
                    <span class="right"><a class="codrops-icon codrops-icon-prev" href="{{ route('logout') }}"><span>Logout {{ Auth::user()->name }}</span></a></span>
                    <span class="right"><a class="codrops-icon codrops-icon-up" href="{{ URL::to('profile' )}}"><span>Moj Profil</span></a></span>
                @endif
            </div>

         @yield('body')

      </div>
         <script src="{{URL::to('js/polyfills.js')}}"></script>
    </body>
</html>
