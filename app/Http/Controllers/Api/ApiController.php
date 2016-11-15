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
use Illuminate\Support\Collection;

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
        $places = Place::all();

        // Get todays order
        $todayOrder = Order::today();

        // If no order exists yet
        if ($todayOrder) {
            // Check if expired
            $expired    = OrderUtil::isExpired($todayOrder);
            $todayOrder = Order::today();

            // If no order is created, return blank object
            if ($todayOrder) {
                $response = [
                    'status'         => strtolower($todayOrder->status),
                    'expired'        => $expired,
                    'expirationTime' => $todayOrder->dateFormated,
                    'order'          => $todayOrder,
                    'place'          => $todayOrder->place,
                    'user'           => $todayOrder->user,
                ];

                // Add place votes
                $response['votes'] = [];

                foreach ($places as $place) {
                    $response['votes'][] = [
                        'id' => $place->id,
                        'name' => $place->short,
                        'votes' => $place->todayVotessCount,
                    ];
                }

                // Sort by votes
                usort($response['votes'], function($a, $b) {
                    return $a['votes'] < $b['votes'];
                });
            }

            return response()->json($response);
        }

        return response()->json(['status' => 'missing']);
    }

    /**
     * Return user orders for today
     *
     * @return Response
     */
    public function orders()
    {
        $result = [];
        $places = Place::all();

        // Get todays order
        $todayOrder = Order::today();

        // If no order exists yet
        if ($todayOrder) {
            // Check if expired
            $expired    = OrderUtil::isExpired($todayOrder);
            $todayOrder = Order::today();

            // If no order is created, return blank object
            if ($todayOrder) {
                $result['orders'] = new Collection;
                $userOrders = UserOrder::where('order_id','=', $todayOrder->id)->get();

                foreach ($userOrders as $userOrder) {
                    $result['orders']->push([
                        'order' => $userOrder->toArray(),
                        'user' => $userOrder->userFull->toArray(),
                    ]);
                }
            }
        }

        return response()->json($result);
    }
}
