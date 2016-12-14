<?php

namespace App\Http\Controllers\Api;

use Auth;
use Input;
use App\Models\User;
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

class GroupsController extends ApiController
{
    /**
     * Groups root
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(['groups' => null]);
    }
}
