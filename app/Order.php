<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Order extends Model
{
    protected $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'date','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function vote(){
        return $this->hasMany('App\Vote','order_id');
    }
    public function place(){
        return $this->belongsTo('App\Place','place_id');
    }
    public function getVotes(){
        return Vote::where('order_id','=',$this->id)->get();
    }

    public static function today(){
        return Order::where('date', '>', date('Y-m-d 00:00:00'))->where('date', '<', date('Y-m-d 23:59:59'))->first();
    }
    public function getDateFormatedAttribute() {
        return str_replace('-', '/', $this->date);
    }

    public function getCountVotesAttribute(){
        return  Vote::where('order_id', '=', $this->id)->get();
    }
}
