<?php namespace App\Http\Services\Auth\Controller;

use App\Http\Services\Auth\Model\User;
use App\Http\Services\Auth\Enum\AuthEnums;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\Auth\Contract\AuthAdapter as AuthCore;

class AuthController extends BaseController {

    protected $auth;


    public function __construct(AuthCore $auth)
    {
        $this->auth = $auth;
    }



    public function login(AuthRequest $request)
    {
        try
        {
            if (!$token = auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password'), 'status' => AuthEnums::ACTIVATE ,'deleted_at' => null]))
            {
                return $this->respondUnprocessable(1004,'invalid_credentials',trans('auth.invalid_credentials'));
            }
        }
        catch (JWTException $e)
        {
            return $this->respondUnprocessable(1005,'could_not_create_token',trans('auth.could_not_create_token'));
        }
        $user = $this->auth->get_user($request->input('username'));
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => false,
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS',
            'Access-Control-Allow-Headers'=> 'Content-Type, Origin,Accept,X-Requested-With,Access-Control-Allow-Origin,Cache-Control, Authorization',
            'Access-Control-Expose-Headers' => 'Content-Type, Origin,Accept,X-Requested-With, Authorization,Access-Control-Allow-Origin',
            'Authorization'=> 'Bearer' . $token
        ];
        return $this->respond(['data'=> $user->id], $headers);
    }




}
