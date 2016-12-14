<?php

namespace App\Util;
use DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Rule;
use App\Models\Vote;
use App\Models\UserOrder;

class UserUtil{

    public static function nextUser($group_id){
        $users = User::with('order')->where('group_id','=', $group_id)->get()->sortBy(function($user) {
            return $user->countOrders;
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
        public static function myVote($me){
            return Vote::where('user_id','=', $me->id)
                        ->where('order_id','=', Order::today()->id)->first();
        }
        public static function myLastOrders($me, $location){

            return DB::table('user_order')
            ->join('order', 'order.id', '=', 'user_order.order_id')
            ->select('user_order.desc', 'order.place_id')
            ->where('user_order.user_id','=', $me)
            ->where('order.place_id','=', $location)
            ->groupBy('user_order.desc', 'order.place_id')
            ->get();

            //return UserOrder::where('user_id','=', $me)->getOrder()->get();
        }
}
