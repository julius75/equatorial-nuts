<?php

namespace App\Jobs;

use App\Models\UserLoginToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RevokeUserLoginTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $tokens =  UserLoginToken::query()
            ->where('verified', '=', true)
            ->where('active', '=', true)
            ->where('revoked', '=', false)
           ->get();
       foreach ($tokens as $token){
           $token->update([
               'revoked'=>true
           ]);
       }
    }
}
