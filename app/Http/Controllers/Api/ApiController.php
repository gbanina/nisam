<?php

namespace App\Http\Controllers\Api;

use Auth;
use Input;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\Rule;
use App\Models\Place;
use App\Models\Order;
use App\Models\UserOrder;
use App\Util\UserUtil;
use App\Util\OrderUtil;
use App\Util\WizzardMain;
use Illuminate\Support\Facades\Redirect;

class ApiController extends Controller
{
    /**
     * API root
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['version' => '1.0']);
    }

    /**
     * Current status
     *
     * @return Response
     */
    public function status()
    {
        // Get todays order
        $todayOrder = Order::today();

        // Check if expired
        $expired    = OrderUtil::isExpired($todayOrder);
        $todayOrder = Order::today();

        // If no order is created, return blank object
        if ($todayOrder) {
            $response = [
                'status'  => strtolower($todayOrder->status),
                'expired' => $expired,
                'order'   => $todayOrder->with(['user', 'place'])->get(),
            ];

            // Get all votes
            $response['votes'] = Vote::with(['place', 'user'])->get();

            return response()->json($response);
        }

        return response()->json(['status' => 'missing']);

        // Now check the order status and return a response









        $wizzard    = new WizzardMain(Auth::user(), $todayOrder);

        return response()->json(['status' => '123', 'order' => $todayOrder]);

        if($todayOrder == null){
            // return $wizzard->start();
        } // start

        if($todayOrder->status == 'CREATED' && !OrderUtil::isExpired($todayOrder)){
            $myVote = UserUtil::myVote(Auth::user());

            if($myVote == null){
                    $view = $wizzard->vote();
                } // vote
            else{
                    $view = $wizzard->wait($myVote);
                } // wait
            // return $view;
        }

        return response()->json();
    }
}
