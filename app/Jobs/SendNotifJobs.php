<?php

namespace App\Jobs;

use App\Notifications\SubscribeNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendNotifJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $subscribe;

    public function __construct($subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send to email user
        
        $email = new SubscribeNotification($this->subscribe);
        Notification::send($this->subscribe, $email);
    }
}
