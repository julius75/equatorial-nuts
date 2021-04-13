<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCode;
use App\Mail\PasswordResetSuccess;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


/**
 * @group Password Management
 *
 * APIs for user reset password
 */
class PasswordResetController extends Controller
{
    /**
     * Send Password Reset Token
     *
     * Send password reset token via Email to the user with provided email address.
     * @bodyParam email string required Email address.
     *
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
             ]
        );
        if ($user && $passwordReset)

            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
        //
        }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
    /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
    /**
     * Update Password
     *
     * Update user's password after token verification.
     * @bodyParam email string required Email address.
     * @bodyParam token string required Email token.
     * @bodyParam password string required Password.
     * @bodyParam password_confirm string required Password, must match password.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user){
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'password' => 'required',
                    'password_confirm' => 'required|same:password',
                ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), compact('user')], Response::HTTP_BAD_REQUEST);
            }
        } else{
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'token' => 'required',
                    'password' => 'required',
                    'password_confirm' => 'required|same:password',
                ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
            }
            if (!$this->verifyResetToken($request->email, $request->token)) {
                return response()->json(['message' => 'Invalid token'], Response::HTTP_BAD_REQUEST);
            }
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found with that email'], Response::HTTP_BAD_REQUEST);
        }
        $user->update(['password' => Hash::make($request->password)]);
        if (PasswordReset::where('email', $request->email)->exists()){
            PasswordReset::where('email', $request->email)->delete();
        }
        $details = [
            'name' => $user->first_name,
            'to' => $user->email,
        ];
        Mail::send(new PasswordResetSuccess($details));
        return response()->json(['message' => 'Password has been reset sucessfully'], Response::HTTP_OK);
    }


    protected function verifyResetToken($email, $token)
    {
        return PasswordReset::where('token', $token)->where('email', $email)->exists();
    }
}
