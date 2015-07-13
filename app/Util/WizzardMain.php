<?php

namespace App\Util;

use Illuminate\Support\Facades\Redirect;
use App\Util\OrderUtil;
use App\Util\UserUtil;
use App\User;
use App\Order;
use App\Rule;
use App\UserOrder;
use App\Place;
use App\Vote;

class WizzardMain{

    private $loggedUser;
    private $todayOrder;

    public function __construct($user, $order){
        $this->loggedUser = $user;
        $this->todayOrder = $order;
    }

    public function start(){
        $places = Place::all();
        $view = view('main.vote');
        $view->with('places', $places);
        $view->with('me', $this->loggedUser->name);

        return $view;
    }
    public function vote(){
        $places = Place::all();
        $view = view('main.wait');
        $view->with('places', $places);
        $view->with('infoMsg', 'Nema još puno vremena! Kam danas idemo jesti?');
        $view->with('expire', $this->todayOrder->dateFormated);
        $view->with('me', $this->loggedUser->name);
        return $view;
    }
    public function wait($myVote){
        $places = Place::all();
        $view = view('main.wait');
        $view->with('places', $places);
        $view->with('infoMsg', 'Glasal si za ' . $myVote->place->name . ' još stignes promeniti.');
        $view->with('myVote', $myVote);
        $view->with('expire', $this->todayOrder->dateFormated);
        $view->with('me', $this->loggedUser->name);

        return $view;
    }
    public function order(){
        $view = view('main.index');
        $users = User::all();
        $userOrders = UserOrder::where('order_id','=', $this->todayOrder->id)->get();

        $myOrder = $userOrders->filter(function($item) {
            return $item->user_id == $this->loggedUser->id;
        })->first();

        if($myOrder == null)    $myOrder = '';
        else                    $myOrder = $myOrder->desc;

        $view->with('users', $users);
        $view->with('orders', $userOrders);
        $view->with('nextUser', UserUtil::nextUser());
        $view->with('myorder', $myOrder);
        $view->with('place', $this->todayOrder->place);

        return $view;
    }
}
