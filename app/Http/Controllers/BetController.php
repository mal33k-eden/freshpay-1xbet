<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BetController extends Controller
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

    //Place a bet:
    //https://aux-one.com/api/ussd/placebet/
    //Allows to place a pre-match or live bet on an event or a number of events.
    // An additional parameter betcode is required which includes the parameters of the bet such as:
    // game id, type of the bet and the stake amount in the currency of the customer's account.
    // Returns a json string with the results of the query.
    public function placeBet(Request $request){
        $request->validate([
            'user_pass' => 'required',
            'phone' => 'required',
            'betcode' => 'required'
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' =>$this->phone_code,
            'phone' => $request->phone,
            'user_pass' => $request->user_pass,
            'betcode' =>$request->betcode,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/placebet/',$params);
    }

    //GET SPORTS:
    //https://aux-one.com/api/ussd/sports/
    //ARequests a list of sports available for betting.
    // Available for non-registered customers. Returns a json string with the sports IDs and names in English in the description field.
    public function getSports(Request $request){

        $request->validate([
            'phone' => 'required',
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => $this->phone_code,
            'phone' => $request->phone,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/sports/',$params);
    }

    //GET GAMES:
    //https://aux-one.com/api/ussd/sports/
    //ARequests a list of sports available for betting.
    // Available for non-registered customers. Returns a json string with the sports IDs and names in English in the description field.
    public function getGames(Request $request){
        $request->validate([
            'phone' => 'required',
            'sport_id'=>'required',
            'page'=>'required',
            'is_live'=>'required',
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => $this->phone_code,
            'phone' => $request->phone,
            'sport_id'=>$request->sport_id,
            'page'=>$request->page,
            'show_all'=>0,
            'is_live'=>$request->is_live,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/sport/',$params);
    }

    //Bet slip check::
    //https://aux-one.com/api/ussd/coupon/
    //Bet slip number is shown in the bet history section of the user account.
    public function checkBetSlip(Request $request){
        $request->validate([
            'phone' => 'required',
            'user_pass'=>'required',
            'coupon'=>'required',
        ]);

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone_code' => $this->phone_code,
            'phone' => $request->phone,
            'coupon'=>$request->coupon,
            'user_pass'=>$request->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url.'/coupon/',$params);
    }





}
