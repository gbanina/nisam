<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Util\OrderUtil;
use App\Util\UserUtil;
use App\Util\WizzardMain;
use App\User;
use App\Order;
use App\Rule;
use App\UserOrder;
use App\Place;
use App\Vote;
use Input;
use Auth;

class MainController extends Controller {

    public function index() {
        $todayOrder = Order::today();
        $wizzard = new WizzardMain(Auth::user(), $todayOrder);

        if($todayOrder == null){
            return $wizzard->start();
        } // start

        if($todayOrder->status == 'CREATED' && !OrderUtil::isExpired($todayOrder)){
            $myVote = UserUtil::myVote(Auth::user());

            if($myVote == null){
                    $view = $wizzard->vote();
                } // vote
            else{
                    $view = $wizzard->wait($myVote);
                } // wait
            return $view;
        }

        return $wizzard->order(); // order
    }

    public function order(){
        $order = Order::today();
        $me = Auth::user()->id;
        if (! $userOrder = UserOrder::where('user_id','=',$me)->where('order_id','=',$order->id)->first())
            $userOrder = new UserOrder;

        $userOrder->user_id = $me;
        $userOrder->desc = Input::get('desc');
        $userOrder->order_id = $order->id;
        $userOrder->save();

        return Redirect::to('main');
    }
    public function vote($id){
        $order = OrderUtil::todayOrder();
        $myVote = UserUtil::myVote(Auth::user());

        $vote = new Vote;

        if($myVote != null){
            $vote = $myVote;
        }

        $vote->user_id = Auth::user()->id;
        $vote->order_id = $order->id;
        $vote->place_id = $id;

        $vote->save();

        return Redirect::to('main');
    }
}
