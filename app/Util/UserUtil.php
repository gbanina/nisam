<?php

namespace App\Util;

use App\User;
use App\Order;
use App\Rule;
use App\Vote;

class UserUtil{

    public static function nextUser(){
        $users = User::with('order')->get()->sortBy(function($user) {
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
}
