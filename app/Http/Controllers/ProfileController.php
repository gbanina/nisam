<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Input;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller {

    public function index() {
        $user =Auth::user();
        $view = view('profile.index')->with($user->toArray());

        return $view;
    }

    public function update(UpdateProfileRequest $request) {


/*
        $validator = $this->validate($request, [
            'email' => 'required',
            'name2' => 'required',
        ]);

        dd($request);
        dd($validator);
*/
        $id = Input::get('id');
        $name = Input::get('name');
        $email = Input::get('email');

        $user = Auth::user();
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make( Input::get('password') ) ;

        $user->save();

        return Redirect::to('profile');
    }

}
