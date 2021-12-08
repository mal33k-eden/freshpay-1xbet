<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    //
    private $key;
    private $pass;
    private $login;
    private $phone;
    private $phone_code;
    private $aux_url;
    public function __construct()
    {
        $this->key = env('AUX_KEY');
        $this->pass = env('AUX_PASSWORD');
        $this->login = env('AUX_LOGIN');
        $this->aux_url = env('AUX_URL');
        $this->phone_code = 243;
    }

    //Make a deposit::
    //https://aux-one.com/api/ussd/deposit/
    public function deposit(Request $request){
        $request->validate([
            'phone' => 'required',
            'user_pass'=>'required',
            'amount'=>'required',
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => $this->phone_code,
            'phone' => $request->phone,
            'amount'=>$request->amount,
            'user_pass'=>$request->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/deposit/',$params);
    }

    //Make a withdrawal::
    //https://aux-one.com/api/ussd/deposit/
    public function withdraw(Request $request){
        $request->validate([
            'phone' => 'required',
            'user_pass'=>'required',
            'amount'=>'required',
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => $this->phone_code,
            'phone' => $request->phone,
            'amount'=>$request->amount,
            'user_pass'=>$request->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/withdraw/',$params);
    }

}
