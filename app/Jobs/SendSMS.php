<?php

namespace App\Jobs;

use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $phone_number;
    public $message;

    /**
     * Create a new job instance.
     *
     * @param $phone_number
     * @param $message
     */
    public function __construct($phone_number, $message)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $username = config('app.africastalking_username');
        $apiKey   = config('app.africastalking_api_key');
        $africasTalking = new AfricasTalking($username, $apiKey);
        $sendSMS = $africasTalking->sms();
        $result = $sendSMS->send([
            'to'=>$this->phone_number,
            'message'=>$this->message
        ]);
        Log::info(json_encode($result));
    }
}
