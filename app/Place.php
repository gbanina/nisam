<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Place extends Model
{
    protected $table = 'place';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'phone','link'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function getTodayVotessCountAttribute(){
        $order = Order::today();

        if($order  == null) return '0';

        return Vote::where('order_id','=', $order->id)
                    ->where('place_id','=', $this->id)
                    ->count();
    }
}
