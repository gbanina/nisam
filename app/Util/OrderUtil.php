<?php

namespace App\Util;

use App\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Vote;
use App\Util\UserUtil;
use DB;
use Log;
use GuzzleHttp\Client as HttpClient;

class OrderUtil{

    public static function todayOrder($group_id){
        $order = OrderUtil::today();

        if($order == null){
            $order = new Order;
            $lifetime = Admin::getValue($group_id, 'vote_expires');
            $time = "+10 min";
            if($lifetime->count() > 0){
                $first = $lifetime->first();
                $time = $first->value;
            }

            if (date("Y-m-d H:i:s A") > date("Y-m-d 10:30:00 AM"))
                $order->date = date('Y-m-d H:i:s', strtotime($time));
            else
                $order->date = date('Y-m-d 10:30:00');

            $order->user_id = UserUtil::nextUser($group_id)->id;

            self::sendOrderNotification($order);
            $order->save();
        }

        return $order;
    }

    public static function today(){
        return Order::where('date', '>', date('Y-m-d 00:00:00'))->where('date', '<', date('Y-m-d 23:59:59'))->first();
    }

    public static function isExpired($order){
        if (date("Y-m-d H:i:s") >= $order->date){
            if ($order->status !== 'CLOSED') {
                $prevStatus = $order->status;
                $order->status = "FINISHED";
                $order->place_id = OrderUtil::topPlace($order->id);
                $order->save();

                // Just finished?
                if ($prevStatus !== "FINISHED") {
                    self::sendVotingDoneNotification($order);
                }
            }

            return true;
        }
        return false;
    }
    public static function topPlace($orderId){
        $votes = Vote::where('order_id', $orderId)
                     ->select(DB::raw('count(*) as vote_count, place_id'))
                     ->groupBy('place_id')
                     ->orderBy('vote_count', 'DESC')
                     ->get();

        // Get max votes, filter places with max votes, and randomize
        $maxVotes = $votes->max('vote_count');
        $votes    = $votes->where('vote_count', $maxVotes);
        $vote     = $votes->random();

        return $vote->place_id;
    }

    /**
     * Send out notification to Slack group
     *
     * @return bool
     */
    public static function sendOrderNotification($order)
    {
        $webhook  = env('SLACK_WEBHOOK');
        $message  = 'Glasanje je počelo. <'.url('/').'|Glasaj i ti!>';
        $sendData = ['text' => $message];
        $headers  = ['Content-Type' => 'application/json'];
        $client   = new HttpClient();

        if ($webhook) {
            try {
                $response = $client->post($webhook, [
                    'headers' => $headers,
                    'body'    => json_encode($sendData),
                ]);
                Log::debug("[SLACK] Message sent.");

                return true;
            } catch (\Exception $e) {
                Log::error("[SLACK] Error: " . $e->getMessage());
            }
        }

        return false;
    }

    /**
     * Send out notification to Slack group
     *
     * @return bool
     */
    public static function sendVotingDoneNotification($order)
    {
        $webhook  = env('SLACK_WEBHOOK');
        $message  = "Glasanje je završilo! \nIdemo u " . $order->place->name . "\n\n Nazvati mora " . $order->user->name;
        $sendData = ['text' => $message];
        $headers  = ['Content-Type' => 'application/json'];
        $client   = new HttpClient();

        if ($webhook) {
            try {
                $response = $client->post($webhook, [
                    'headers' => $headers,
                    'body'    => json_encode($sendData),
                ]);
                Log::debug("[SLACK] Message sent.");

                return true;
            } catch (\Exception $e) {
                Log::error("[SLACK] Error: " . $e->getMessage());
            }
        }

        return false;
    }

    /**
     * Send out notification to Slack group
     *
     * @return bool
     */
    public static function sendOrderDoneNotification($order)
    {
        $webhook  = env('SLACK_WEBHOOK');
        //Svi su narucili i Luka je nazval. Dobar tek!
        $message  = "Svi su narucili i " . $order->user->name . " je nazval.\n Dobar tek!";
        $sendData = ['text' => $message];
        $headers  = ['Content-Type' => 'application/json'];
        $client   = new HttpClient();

        if ($webhook) {
            try {
                $response = $client->post($webhook, [
                    'headers' => $headers,
                    'body'    => json_encode($sendData),
                ]);
                Log::debug("[SLACK] Message sent.");

                return true;
            } catch (\Exception $e) {
                Log::error("[SLACK] Error: " . $e->getMessage());
            }
        }

        return false;
    }
}
