<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureOTPAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $active_token = $user->activeLoginToken();
        if ($active_token){
                return $next($request);
        }else{
//            //log user out
//            try{
//                Auth::user()->tokens->each(function ($token, $key){
//                    $token->delete();
//                });
//            }catch (\Exception $exception){
//                Log::error($exception);
//            }
            return response()->json(['message' => 'OTP session has expired, request new OTP.'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
