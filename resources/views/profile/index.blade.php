@extends('layouts.base')

@section('body')
         <div class="component myprofile">
            <h2>Profile Edit</h2>
            <!-- Start Nav Structure -->
            <button onclick="document.getElementById('login-form').submit();" class="cn-button" id="cn-button">Spremi</button>

            <div class="page-container" class="cn-button" style="margin-top:-150px; left:50%;top:25%;margin-left: -18.25em;">
               <form class="bl_form" id="login-form" action="{{ route('profile.update') }}" method="post" accept-charset="utf-8" role="form">
                @if (Session::get('errors'))
                    <ul><p>
                    @foreach (Session::get('errors')->all() as $error)
                        {{$error}}
                    @endforeach
                    </p></ul>
                @else
                    <br>
                @endif
               <br><br>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id" id="id" value="{{$id}}">
                 <input type="name" class="label_better" name="name" id="name" data-new-placeholder="Ime" placeholder="Ime" value="{{$name}}">
                 <input type="email" class="label_better" name="email" id="email" data-new-placeholder="Email" placeholder="Email" value="{{$email}}">
                 <input type="password" class="label_better" name="password" id="password" data-new-placeholder="Lozinka" placeholder="Lozinka" value="">
               </form>
            </div>
         </div>



@stop
