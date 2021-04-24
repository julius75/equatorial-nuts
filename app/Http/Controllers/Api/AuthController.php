<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Mail\Registered;
use App\Models\User;
use App\Models\UserLoginToken;
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
     * @bodyParam phone_number string required Phone Number.
     * @bodyParam password string required Password.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'phone_number'=>'required',
                'password' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $check_if_active = User::role('buyer')->where('phone_number', '=', '254'.substr($request->phone_number, -9))->first();
        if ($check_if_active){
            if ($check_if_active->status == false){
                return response()->json(['message' => 'User Account is Inactive, contact support@equatorial.co.ke for assistance'], Response::HTTP_OK);
            }
        }
        else{
            return response()->json(['message' => 'Buyer Credentials Not Found'], Response::HTTP_BAD_REQUEST);
        }
        if (Auth::attempt(['phone_number' => '254'.substr($request->get('phone_number'), -9), 'password' => request('password')])) {
            $user = Auth::user();
            if (env('APP_ENV') == 'production') {
                $token = $this->getPassportToken('254'.substr($request->get('phone_number'), -9), $request->get('password'));
            }
            else {
                //mimic production response
                $token = [
                    "token_type"=>"Bearer",
                    "expires_in"=>604800,
                    "access_token"=>$user->createToken('authToken')->accessToken
                ];
            }
            //check previous token
            $check_prev = $user->login_token()
                ->where('verified', '=', false)
                ->where('active', '=', false)
                ->where('revoked', '=', false)->first();
            if ($check_prev){
                $check_prev->update(['revoked'=>true]);
            }
            //create new token
            $newToken = new UserLoginToken();
            $newToken->user_id = $user->id;
            $newToken->token = rand(1000,9999);
            $newToken->token_expires_at = Carbon::now()->addMinutes(10);
            $newToken->created_at = Carbon::now();
            $newToken->updated_at = Carbon::now();
            $newToken->save();

            $message = "Dear $user->first_name $user->last_name.\nYour ENP login OTP is: $newToken->token";

            SendSMS::dispatch($user->phone_number, $message);

            $user_details = [
                'id'=>$user->id,
                'role'=>$user->roles->first()->name,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'status'=>$user->status,
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

    /**
     * Verify Buyer's Login Token
     *
     * @authenticated
     *
     * @bodyParam token integer required OTP.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify_OTP(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'token' => 'required|exists:user_login_tokens,token',
            ]);
        if ($validator->fails())
            return response()->json(['message' => $validator->errors()->first()], \Illuminate\Http\Response::HTTP_BAD_REQUEST);

        $user = Auth::user();
        $code = $user->login_token()->where('token', '=', $request->token)->first();
        if (!$code)
        {
            return response()->json(['message' => 'Invalid OTP'], Response::HTTP_NOT_FOUND);
        }
        else if ($code->revoked == true) {
            return response()->json(['message' => 'You have entered a revoked OTP.'], Response::HTTP_BAD_REQUEST);
        }
        else if ($code->verified == true) {
            $code->update(['active'=>true]);
            return response()->json(['message' => 'OTP Already Verified'], Response::HTTP_OK);
        }
        else if (Carbon::now() > Carbon::parse($code->token_expires_at)){
            return response()->json(['message' => 'OTP has expired, request for a new OTP'], Response::HTTP_BAD_REQUEST);
        }
        else if ($code->verified == false){
            $code->update([
                'verified'=>true,
                'active'=>true,
                'updated_at'=>now()
            ]);
            return response()->json(['message' => 'OTP Verified Successfully'], Response::HTTP_OK);
        }
        else{
            return response()->json(['message'=> "Failed to Verify OTP, Refresh page and try again"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Resend OTP
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend_OTP(Request $request){
        $user = Auth::user();
        $code = UserLoginToken::query()
            ->where('user_id', '=', $user->id)
            ->where('verified', '=', false)
            ->where('active', '=', false)
            ->where('revoked', '=', false)
            ->first();
        if (!$code){
            return response()->json(['message' => 'User does not have an unverified OTP'], Response::HTTP_NOT_FOUND);
        }else{
            //send otp
            $code->update([
                'revoked' => true
            ]);

            $newToken = new UserLoginToken();
            $newToken->user_id = $user->id;
            $newToken->token = rand(1000,9999);
            $newToken->token_expires_at = Carbon::now()->addMinutes(10);
            $newToken->created_at = Carbon::now();
            $newToken->updated_at = Carbon::now();
            $newToken->save();

            $message = "Dear $user->first_name $user->last_name.\nYour ENP login OTP is: $newToken->token";

            SendSMS::dispatch($user->phone_number, $message);
            return response()->json(['message' => 'OTP Resent'], Response::HTTP_OK);
        }

    }

}
