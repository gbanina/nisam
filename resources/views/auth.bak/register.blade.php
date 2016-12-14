@extends('layouts.base')

@section('body')
<section class="col-md-9">
    <h1>register</h1>
    <form action="{{ route('post.register') }}" method="post" accept-charset="utf-8" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- print errors -->
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach

         <label for="email">Email:</label>
         <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="your@email.com">

         <label for="name">Name:</label>
         <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="your name">


        <label for="password">Password (min 6)</label>
        <input type="password" name="password" id="password" value="{{ old('password') }}">

        <label for="password_confirmation">Password again</label>
        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">

        <button type="submit">send</button>
    </form>
</section>
@stop
