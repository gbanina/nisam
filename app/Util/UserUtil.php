<?php

namespace App\Util;

use App\User;
use App\Order;
use App\Rule;

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
}
