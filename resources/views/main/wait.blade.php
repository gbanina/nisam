@extends('layouts.base')

@section('body')
            <div class="component">
                <h2><span id="clock"></span></h2>
                <button class="cn-button" id="cn-button">Promeni</button>
                <div class="cn-wrapper" id="cn-wrapper">
                    <ul>
                        @foreach ($places as $place)
                            <li><a href="{{{ route('main.vote', $place->id) }}}"><span>{{ $place->short }}</span></a></li>
                        @endforeach
                     </ul>
                </div>
            </div>
            <header>
                <h1>{{$me}},
                    <span>{{$infoMsg}}</span>
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
