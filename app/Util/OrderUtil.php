<?php

namespace App\Util;

use App\User;
use App\Order;
use App\Util\UserUtil;

class OrderUtil{

    public static function todayOrder(){
        $today = OrderUtil::today();
        if($today == null){
            $order = new Order;
            $order->date = date('Y-m-d H:i:s', strtotime("+10 min"));
            $order->user_id = UserUtil::nextUser()->id;
            $order->save();
        }

        return $order;
    }

    public static function today(){
        return Order::where('date', '>', date('Y-m-d 00:00:00'))->where('date', '<', date('Y-m-d 23:59:59'))->first();
    }

    public static function isExpired($order){
        if (date("Y-m-d H:i:s") > $order->date){
            $order->status = "FINISHED";
            $order->save();
            return true;
        }
        return false;
    }
}
