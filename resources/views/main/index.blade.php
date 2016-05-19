@extends('layouts.base')

@section('body')
            <div class="component">
                <h2>Ko zove danas?</h2>
                    <ul data-piemenu-autoinit="1" data-piemenu-range="360">
                        @foreach ($users as $user)
                            <li><a href="#" title="{{ $user->name }} je zvao {{ $user->countOrders }} puta."><span>{{ $user->name }}</span></a></li>
                        @endforeach
                     </ul>
            </div>
            <header>
                @if ($status != 'CLOSED')
                
                <h1>{{$nextUser->name}}...
                    <span>Idemo u {{$place->name}}. Na tebi je red da <a href="#"  onclick="$( '#dialog' ).dialog( 'open' )">nazoveš!</a></span>
                    {!! Form::open(array('route' => 'main.changeUser','id' => 'chainge-form')) !!}
                    {!! Form::close() !!}
                </h1>
                    <nav class="codrops-demos">
                        {!! Form::open(array('route' => 'main.order','id' => 'order-form')) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <select class="area_better">
                            <option value="" disabled selected>Tvoji zadnji gableci.</option>
                            @foreach ($lastOrders as $order)
                                <option value="{{$order->id}}">{{$order->desc}}</option>
                            @endforeach
                        </select>

                        <br><br>
                        <textarea class="area_better" rows="4" cols="50" type="text" name="desc" id="desc">{{$myorder}}</textarea><br>
                         <a href="#" onclick="document.getElementById('order-form').submit();">Naruci!</a>
                         ili budi drug i
                         <a href="#" onclick="document.getElementById('chainge-form').submit();">Preuzmi odgovornost!</a>
                        {!! Form::close() !!}
                    </nav>
                @else
                    <nav class="codrops-demos">
                        <h1>Svi su narucili i {{$nextUser->name}} je nazval. Dobar tek!</h1>
                    </nav>
                @endif

            </header>

            <section>
                <h2><a href="{{$place->link}}" target="_blank">{{$place->short}}</a></h2>
                @foreach ($orders as $order)
                    <p>{{$order->userFull->name}} - {{$order->desc}}</p>
                @endforeach
            </section>

<div id="dialog" title="Zoveš : {{$place->short}} - {{$place->phone}}">
    @foreach ($orders as $order)
        <p>{{$order->userFull->name}} - {{$order->desc}}</p>
    @endforeach
</div>

<script src="js/dialog.js"></script>
<script src="js/demo2.js"></script>

@stop
