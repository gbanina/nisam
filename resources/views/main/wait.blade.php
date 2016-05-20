@extends('layouts.base')

@section('body')
            <div class="component" ng-controller="TodosController">
                <h2><span id="clock"></span></h2>
                    <ul data-piemenu-autoinit="1" data-piemenu-range="360">
                            <li ng-repeat="vote in votes">
                                <a href="{{{ route('main.vote', '') }}}/@{{vote.id}}"><span>@{{vote.short}} (@{{vote.votes}})</span></a>
                            </li>
                     </ul>
            </div>
            <header>
                <h1>{{$me}},
                    <span>{{$infoMsg}}</span>
                </h1>
            </header>
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
            <script src="js/main.js"></script>
            <script>

            $('#clock').countdown('{{$expire}}', function(event) {
               $(this).html(event.strftime('%H:%M:%S'));
                    }).on('finish.countdown', function(event) {
                        window.location.href = "{{ route('main') }}";
                    });
            </script>
		  <script src="js/demo2.js"></script>
@stop
