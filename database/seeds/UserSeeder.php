<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run() {
        User::create( [
            'email' => 'zbiskup@gmail.com' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Zvonko'
        ] );
        User::create( [
            'email' => 'luka.peharda@gmail.com ' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Luka'
        ] );
        User::create( [
            'email' => 'zjambor@gmail.com' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Zoran'
        ] );
        User::create( [
            'email' => 'gbanina@gmail.com' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Goran'
        ] );
        User::create( [
            'email' => 'fffilo@gmail.com' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Franjo'
        ] );
        User::create( [
            'email' => 'davor.jambor@gmail.com' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Davor'
        ] );
        User::create( [
            'email' => 'office@creolab.hr' ,
            'password' => Hash::make( 'password' ) ,
            'name' => 'Boris'
        ] );
    }
}
