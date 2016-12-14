<?php

namespace App\Models;

use App\Models\Order;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function getCountOrdersAttribute()
    {
        return  Order::where('user_id', '=', $this->id)->where('status','=','CLOSED')->count();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function order(){
        return $this->hasMany('App\Models\UserOrder','user_id');
    }

    public function group(){
        return $this->belongsTo('App\Models\Group','group_id');
    }
    public static function getUsersByGroup($group_id){
        return User::where('group_id','=', $group_id)->get();
    }
}
