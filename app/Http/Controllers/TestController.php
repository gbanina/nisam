<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Util\OrderUtil;
use App\Util\UserUtil;
use App\Util\WizzardMain;
use App\User;
use App\Models\Order;
use App\Models\Rule;
use App\Models\UserOrder;
use App\Models\Place;
use App\Models\Vote;
use Input;
use Auth;

class TestController extends Controller {

    public function index() {
        $view = view('main.test');
        return $view;
    }

    public function votes(){
        $places = Place::all();
        foreach($places as $key=>$place)
            $places[$key]['votes'] = $place->getTodayVotessCountAttribute();

        return $places;
    }
    public function orders(){
        $todayOrder = Order::today();
        return UserOrder::where('order_id','=', $todayOrder->id)->get();
    }
}
