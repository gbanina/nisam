@extends('layouts.base')

@section('body')
            <div class="component" ng-app="nisamApp">
                <h2><span id="clock"></span></h2>
                <button class="cn-button" id="cn-button">Promeni</button>
                <div class="cn-wrapper" id="cn-wrapper" ng-controller="TodosController">
                    <ul>
                        <li ng-repeat="vote in votes">
                            <a href="{{{ route('main.vote', '') }}}/@{{vote.id}}"><span>@{{vote.short}} (@{{vote.votes}})</span></a>
                        </li>
                     </ul>
                </div>
            </div>
            <header>
                <h1>{{$me}},
                    <span>{{$infoMsg}}</span>
                </h1>
            </header>
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script src="js/main.js"></script>
        <script>
            (function(){

                var button = document.getElementById('cn-button'),
                wrapper = document.getElementById('cn-wrapper');

                var open = false;
                button.addEventListener('click', handler, true);

                function handler(){
                  if(!open){
                    this.innerHTML = "Zatvori";
                    classie.add(wrapper, 'opened-nav');
                  }
                  else{
                    this.innerHTML = "Promeni";
                    classie.remove(wrapper, 'opened-nav');
                  }
                  open = !open;
                }
                function closeWrapper(){
                    classie.remove(wrapper, 'opened-nav');
                }

            })();

        $('#clock').countdown('{{$expire}}', function(event) {
           $(this).html(event.strftime('%H:%M:%S'));
                }).on('finish.countdown', function(event) {
                    window.location.href = "{{ route('main') }}";
                });
        </script>

@stop
