<?php

namespace App\Util;

use Illuminate\Support\Facades\Redirect;
use App\Util\OrderUtil;
use App\Util\UserUtil;
use App\Models\User;
use App\Models\Order;
use App\Models\Rule;
use App\Models\UserOrder;
use App\Models\Place;
use App\Models\Vote;

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
        $users = User::getUsersByGroup($this->loggedUser->group_id);
        $userOrders = UserOrder::where('order_id','=', $this->todayOrder->id)->get();

        $myOrder = $userOrders->filter(function($item) {
            return $item->user_id == $this->loggedUser->id;
        })->first();

        if($myOrder == null)    $myOrder = '';
        else                    $myOrder = $myOrder->desc;

        $view->with('lastOrders', UserUtil::myLastOrders($this->loggedUser->id,$this->todayOrder->place_id));
        $view->with('users', $users);
        $view->with('orders', $userOrders);
        $view->with('nextUser', $this->todayOrder->user);
        $view->with('myorder', $myOrder);
        $view->with('place', $this->todayOrder->place);
        $view->with('status', $this->todayOrder->status);

        return $view;
    }
}
