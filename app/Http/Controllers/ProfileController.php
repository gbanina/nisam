<?php

namespace App\Http\Controllers;
use App\User;

class ProfileController extends Controller {

    public function index(User $user) {
        return view('profile.index')->with($user->toArray());
    }

}
