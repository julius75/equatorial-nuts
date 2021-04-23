<?php

namespace App\Console\Commands;

use App\Jobs\SendSMS;
use App\Models\UserLoginToken;
use Illuminate\Console\Command;

class RevokeUserLoginTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enp:revokelogintokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revokes Login Tokens created in the course of the Day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tokens = UserLoginToken::query()
            ->where('verified', '=', true)
            ->where('active', '=', true)
            ->where('revoked', '=', false)
            ->exists();
            if ($tokens){
                \App\Jobs\RevokeUserLoginTokens::dispatch();
            }
        SendSMS::dispatch('254725730055', 'Console Config Worked! @'.now());

    }
}
