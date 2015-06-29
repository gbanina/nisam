@extends('layouts.base')

@section('body')
         <div class="component">
            <h2>Ko zove danas?</h2>
            <!-- Start Nav Structure -->
            <button onclick="document.getElementById('login-form').submit();" class="cn-button" id="cn-button">Login</button>

            <div class="page-container" class="cn-button" style="margin-top:-100px; left:50%;margin-left: -12.25em;">
               <form class="bl_form" id="login-form" action="{{ route('post.login') }}" method="post" accept-charset="utf-8" role="form">
               <br><br><br>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="email" class="label_better" name="email" id="email" data-new-placeholder="Email Address" placeholder="Email Address">
                 <input type="password" class="label_better" name="password" id="password" data-new-placeholder="Password" placeholder="Password">


                    <label>
                     <input type="checkbox" name="remember" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
                     </label>
               </form>
            </div>
         </div>
               <header style="margin-top:-0px">
               <h1>Nisam!<span>Web aplikacija za automatizirano odlučivanje redosljeda naručivanja.</span>
               </h1>
         </header>

         <section>
            <p>Santa Maria 042/330 000</p>
            <p>Kneginečka Hiža 042/690 193</p>
            <p>Zalogajnica Šanjek 042/212-718</p>
         </section>
@stop
