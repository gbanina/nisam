<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Order;
use App\UserOrder;
use Input;
use Auth;

class MainController extends Controller {

    public function index() {
        $users = User::all();
        $orders = UserOrder::where('order_id','=', $this->getOrder()->id);

        $view = view('main.index');
        $view->with('users', $users);
        $view->with('orders', $orders->get());
        $view->with('nextUser',$this->getNextUser());

        return $view;
    }

    public function create(){
        $order = $this->getOrder();
        $me = Auth::user()->id;
        if (! $userOrder = UserOrder::where('user_id','=',$me)->where('order_id','=',$order->id)->first())
            $userOrder = new UserOrder;

        $userOrder->user_id = $me;
        $userOrder->desc = Input::get('desc');
        $userOrder->order_id = $order->id;
        $userOrder->save();

        return Redirect::to('main');
    }

    private function getOrder(){
        $today = date('Y-m-d');
        $todayOrder = Order::where('date', '=', $today)->get();

        if($todayOrder->isEmpty()){
            $todayOrder = new Order;
            $todayOrder->date = $today;
            $todayOrder->user_id = $this->getNextUser()->id;
            $todayOrder->save();
        }

        return $todayOrder->first();
    }

    private function getNextUser(){
        $users = User::with('order')->get()->sortBy(function($user) {
            return $user->order->count();
        });
        return $users->first();
    }
}
