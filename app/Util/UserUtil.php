<?php

namespace App\Util;

use App\User;
use App\Models\Order;
use App\Models\Rule;
use App\Models\Vote;

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
}
