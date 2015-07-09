@extends('layouts.base')

@section('body')

            <div class="component">
                <h2>Di jedemo?</h2>
                <button class="cn-button" id="cn-button">Glasaj!</button>
                <div class="cn-wrapper" id="cn-wrapper">
                    <ul>
                        @foreach ($places as $place)
                            <li><a href="{{{ route('main.vote', $place->id) }}}"><span>{{ $place->short }} ({{ $place->todayVotessCount }})</span></a></li>
                        @endforeach
                     </ul>
                </div>
            </div>

            <header>
                <h1>{{$me}},
                    <span>Preuzmi inicijativu! Kam idemo jest?</span>
                </h1>
            </header>

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
                    this.innerHTML = "Glasaj!";
                    classie.remove(wrapper, 'opened-nav');
                  }
                  open = !open;
                }
                function closeWrapper(){
                    classie.remove(wrapper, 'opened-nav');
                }

            })();
        </script>

@stop
