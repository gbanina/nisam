<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Util\OrderUtil;
use App\Util\UserUtil;
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

        if($todayOrder == null){
                // create countdown
                var_dump('start');
                $places = Place::all();
                $view = view('main.vote');
                $view->with('places', $places);
                $view->with('me', Auth::user()->name);
        }else{
            if($todayOrder->status == 'CREATED' && !OrderUtil::isExpired($todayOrder)){

                $myVote = Vote::where('user_id','=', Auth::user()->id)->where('order_id','=', $todayOrder->id);

                if($myVote->first() == null){
                    var_dump('vote');
                    $view = view('main.wait');
                    $view->with('infoMsg', 'Nema još puno vremena! Kam danas idemo jesti?');
                }
                else{
                    var_dump('wait');
                    $view = view('main.wait');
                    $view->with('infoMsg', 'Glasal si za ' . $myVote->first()->place->name . ' još stignes promeniti.');
                    $view->with('myVote', $myVote->first());
                }
                $view->with('expire', $todayOrder->dateFormated);

                $places = Place::all();
                $view->with('places', $places);
                $view->with('me', Auth::user()->name);
            }else{
                // vote closed, order your food
                var_dump('order');
                $view = view('main.index');
                $users = User::all();
                $userOrders = UserOrder::where('order_id','=', $todayOrder->id)->get();

                $myOrder = $userOrders->filter(function($item) {
                    return $item->user_id == Auth::user()->id;
                })->first();

                if($myOrder == null)    $myOrder = '';
                else                    $myOrder = $myOrder->desc;

                $view->with('users', $users);
                $view->with('orders', $userOrders);
                $view->with('nextUser', UserUtil::nextUser());
                $view->with('myorder', $myOrder);
                $view->with('place', $todayOrder->place->name);
            }
        }

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
    public function vote($id){
        //$order = Order::today();

        //dd(UserUtil::nextUser());
        $order = OrderUtil::todayOrder();

        $vote = new Vote;
        $vote->user_id = Auth::user()->id;
        $vote->order_id = $order->id;
        $vote->place_id = $id;

        $vote->save();

        return Redirect::to('main');
    }
}
