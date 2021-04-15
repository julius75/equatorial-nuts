<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Registered;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Login
 *
 * APIs for user authentication
 */
class AuthController extends Controller
{
    /**
     * Login
     *
     * Log a user into the system. After successful login, a bearer token is returned which you may store and use for
     * authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
     * a mechanism to check whether the token has expired before requiring the user to login again.
     * @bodyParam email string required Email address.
     * @bodyParam password string required Password.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $check_if_active = User::where('email', '=', $request->get('email'))->first();
        if ($check_if_active){
            if ($check_if_active->is_active == false){
                return response()->json(['message' => 'User Account is Inactive, contact support@ruv.com for assistance'], Response::HTTP_BAD_REQUEST);
            }
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            if (env('APP_ENV') == 'production') {
                $token = $this->getPassportToken($request->get('email'), $request->get('password'));
            }
            else {

                //mimic production response
                $token = [
                    "token_type"=>"Bearer",
                    "expires_in"=>604800,
                    "access_token"=>$user->createToken('authToken')->accessToken
                ];

            }

            $user_details = [
                'id'=>$user->id,
                'role'=>$user->roles->first()->name,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'is_active'=>$user->is_active,
            ];

            return response()->json(
                [
                    'user_details' => $user_details,
                    'token' => $token,
                ],
                Response::HTTP_OK
            );

        }else{
            return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get Laravel Passport Token
     * @param $username
     * @param $password
     * @return mixed
     */
    protected function getPassportToken($username, $password)
    {
        $http = new Client;
        $form_params = [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('app.passport_client_id'),
                'client_secret' => config('app.passport_client_secret'),
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ]
        ];
        $response = $http->post(
            config('app.token_url'),
            $form_params
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Verify Passcode (OTP)
     *
     * Verify passcode provided by the user for OTP.
     * @authenticated
     * @bodyParam passcode string required Passcode that was sent via Email.
     */
    public function verifyPasscode(Request $request)
    {
        if (Auth::user()->default_phone_number()->phone_verified_at != null) {
            return response()->json(['message' => 'Passcode already verified'], Response::HTTP_OK);
        }

        if ($request->passcode == Auth::user()->passcode) {
            Auth::user()->default_phone_number()->update(['phone_verified_at' => Carbon::now(), 'is_active'=>true]);
            $details = [
                'name' => Auth::user()->first_name. ' '.Auth::user()->last_name,
                'to' => Auth::user()->email,
            ];
            Mail::send(new Registered($details));

            return response()->json(['message' => 'Passcode verified. Please login'], Response::HTTP_OK);
        }
        else {
            return response()->json(['message' => 'Invalid passcode'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Logout
     *
     * Log a user out of the system.
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::check()){
            Auth::user()->tokens->each(function ($token, $key){
                $token->delete();
            });
            return response()->json(['message' => 'User Logged Out Successfully'], Response::HTTP_OK);
        }
        return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
    }

    protected function passcode($min = 1000, $max = 9999)
    {
        return mt_rand($min, $max);
    }
}
