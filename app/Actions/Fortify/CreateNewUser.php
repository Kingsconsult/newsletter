<?php

namespace App\Actions\Fortify;

use App\Events\RegisteredMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redis;



class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    /**
     * Validate and create a newly registered user.
     *super     
     * @param  array  $input
     * @return \App\Models\User 
     */

    public function __construct()
    {
    }
    public function create(array $input)
    {



        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => $this->passwordRules(),
        ])->validate();





        // $redis = Redis::connection();


        // $response = $redis->get('users');


        // $array = array(
        //     'firstname' => $input['firstname'],
        //     'lastname' => $input['lastname'],
        //     'username' => $input['username'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password'])
        // );



        // $oldArray = [];


        // array_push($oldArray,  $array);

        // $redis->set('users', json_encode([
        //         'id' => $oldArray 
        //     ])
        // );

        // $response1 = $redis->get('users');

        // $response1 = json_decode($response);

        // return $response;


        // // $getUser =   Redis::get('user');

        // // print_r($getUser);
        // print_r($oldArray);
        // exit();


        $user = User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // event(new Registered($user));
        event(new RegisteredMail($user));

        return $user;
    }
}
