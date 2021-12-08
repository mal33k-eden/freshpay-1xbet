<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuxUtilityAuth extends Controller
{
    //
    private $key;
    private $pass;
    private $login;
    private $phone;
    private $phone_code;
    private $user_pass;
    private $aux_url;
    public function __construct()
    {
        $this->key = env('AUX_KEY');
        $this->pass = env('AUX_PASSWORD');
        $this->login = env('AUX_LOGIN');
        $this->user_pass = env('AUX_USER_PASS');
        $this->aux_url = env('AUX_URL');
    }

    //Authorization:
    //Checking if the user provided the correct password
    public function auth(Request $request){
        $request->validate([
            'user_pass' => 'required',
            'phone' => 'required',
        ]);

         $params = [
             'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => 243,
             'phone' => $request->phone,
            'user_pass' => $request->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/authorization/',$params);
    }

    //User registration:
    //https://aux-one.com/api/ussd/registration/
    //For the registration of a new customer. Returns a json string with the results of the query.
    public function register(Request $request){
        $request->validate([
            'phone' => 'required',
        ]);
        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone' => $request->phone,
            'phone_code' => 243,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/registration/',$params);
        //{"success":true,"description":{"user_id":349845077,"password":"5ca4uaec"}}
    }

    //Password reset:
    //https://aux-one.com/api/ussd/passreset/
    //Allows to reset the user’s password. The transfer of the old password is not required. Returns a json string with the results of the query.
    public function passreset(Request $request){
        $request->validate([
            'phone' => 'required',
        ]);
        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone' => $request->phone,
            'phone_code' => 243,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/passreset/',$params);
    }

    //Customer balance request:
    //https://aux-one.com/api/ussd/balance/
    //Provides the current balance for a customer. An additional parameter "user_pass" is required. Returns a json string with the results of the query.
    public function balance(Request $request){
        //kdbzm9kt
        $request->validate([
            'phone' => 'required',
            'user_pass' => 'required',
        ]);
        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone' => $request->phone,
            'phone_code' => 243,
            'user_pass' => $request->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/balance/',$params);
    }

    //Callback request:
    //https://aux-one.com/api/ussd/callback/
    //Requests a callback from the company customer support. An additional "user_pass" parameter is required. Returns a json string with the results of the query.
    public function callback(){
        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone' => 828387390,
            'phone_code' => 243,
            'user_pass' => $this->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/callback/',$params);
    }
}
