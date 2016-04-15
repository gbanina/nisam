@extends('layouts.base')

@section('body')

            <div class="component">
                <h2>Di jedemo?</h2>
                    <ul data-piemenu-autoinit="1" data-piemenu-range="360">
                        @foreach ($places as $place)
                            <li><a href="{{{ route('main.vote', $place->id) }}}"><span>{{ $place->short }} ({{ $place->todayVotessCount }})</span></a></li>
                        @endforeach
                     </ul>
            </div>

            <header>
                <h1>{{$me}},
                    <span>Preuzmi inicijativu! Kam idemo jest?</span>
                </h1>
            </header>

@stop
