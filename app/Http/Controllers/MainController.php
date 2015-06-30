<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Order;
use App\Rule;
use App\UserOrder;
use Input;
use Auth;

class MainController extends Controller {

    public function index() {
        $users = User::all();
        $orders = UserOrder::where('order_id','=', $this->getOrder()->id)->get();

        $myOrder = $orders->filter(function($item) {
            return $item->user_id == Auth::user()->id;
        })->first();

        if($myOrder == null)    $myOrder = '';
        else                    $myOrder = $myOrder->desc;

        $view = view('main.index');
        $view->with('users', $users);
        $view->with('orders', $orders);
        $view->with('nextUser', $this->getNextUser());
        $view->with('myorder', $myOrder);

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

        foreach ($users as $user){
            $rules = Rule::forUser($user->id);
            if($rules->count() == 0)
                return $user;

            foreach($rules as $rule){
                    $condition = false;
                    eval('$condition = ' . $rule->condition . ';');
                    if(!$condition)
                        return $user;
                }
            }
        }
}
