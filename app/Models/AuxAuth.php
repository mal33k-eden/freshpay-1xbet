<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class AuxAuth extends Model
{
    use HasFactory;
    private $key;
    private $pass;
    private $login;
    private $phone;
    private $phone_code;
    private $user_pass;
    private $aux_url;

    /**
     * AuxAuth constructor.
     */
    public function __construct()
    {
        $this->key = env('AUX_KEY');
        $this->pass = env('AUX_PASSWORD');
        $this->login = env('AUX_LOGIN');
        $this->user_pass = env('AUX_USER_PASS');
        $this->aux_url = env('AUX_URL');
    }

    private function GET_AUTH(){

        $params = [
            'login'=>$this->login,
            'pass' => $this->pass,
            'phone' => 9893651314,
            'phone_code' => 7,
            'user_pass' => $this->user_pass,
        ];
        ksort($params);
        $params['hash'] = base64_encode(hash_hmac('sha1', http_build_query($params), $this->key));
        return Http::post($this->aux_url,$params);
    }


}
