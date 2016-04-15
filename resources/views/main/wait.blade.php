@extends('layouts.base')

@section('body')
            <div class="component">
                <h2><span id="clock"></span></h2>
                    <ul data-piemenu-autoinit="1" data-piemenu-range="360">
                        @foreach ($places as $place)
                            <li><a href="{{{ route('main.vote', $place->id) }}}"><span>{{ $place->short }} ({{ $place->todayVotessCount }})</span></a></li>
                        @endforeach
                     </ul>
            </div>
            <header>
                <h1>{{$me}},
                    <span>{{$infoMsg}}</span>
                </h1>
            </header>
        <script>

        $('#clock').countdown('{{$expire}}', function(event) {
           $(this).html(event.strftime('%H:%M:%S'));
                }).on('finish.countdown', function(event) {
                    window.location.href = "{{ route('main') }}";
                });
        </script>

@stop
